<?php

namespace App\Http\Controllers\Api;

use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Logs;
use App\Models\Token;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens;
    public function register(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'register']);
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|unique:clients|digits:11',
            'birth_date' => 'required|date_format:Y-m-d',
            'password' => 'required',
            'email' => 'required|unique:clients',
            'last_donation' => 'required|date_format:Y-m-d',
            'blood_type_id' => 'required|exists:blood_types,id',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        // Correct the usage of Str::random
        $client->api_token = Str::random(60);
        $client->{'0'} = $client->api_token;
        $client->save();
     // $Token = $client->createToken('authToken')->Token;

        // Attach relationships
  ///       if ($client->city && $client->city->governorate_id) {
 ///        $client->governorate()->attach($client->city->governorate_id);
   ///   }

       /// if ($request->has('blood_type_id')) {
     ///       $client->BloodType()->attach($request->input('blood_type_id'));
     ///   }
         $client->governorate()->attach($client->city->governorate_id);
         $client->bloodType()->attach($request->blood_type_id);
        // Return JSON response with correct loading of relations
        return responseJson(1, 'تم الاضافة بنجاح', [
            'api_token' => $client->api_token,
        //    '0' => $client->api_token,
            'client' => new \App\Http\Resources\Client($client->load('city.governorate', 'bloodType'))
        ]);

    }

    public function login(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'login']);
        $validator = validator()->make($request->all(), [
            'password' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                if ($client->is_active == 0) {
                    return responseJson(0, 'تم حظر حسابك .. اتصل بالادارة');
                }

                // $accessToken = $client->createToken('authToken')->accessToken;
                return responseJson(1, 'تم تسجيل الدخول', [
                    'api_token' => $client->api_token,
                    'client' => $client->load('city.governorate', 'bloodType')
                ]);
            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحة');
            }
        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحة');
        }
    }

    public function profile(Request $request): JsonResponse
    {
        $validation = validator()->make($request->all(), [
            'password' => 'confirmed',
            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        // Eloquent
        //  auth()->user(); // user -> web
        //  auth()->guard('api')->user(); // user -> api
        // $request->user();// user -> middleware guard

        $loginUser = $request->user(); // object Client Model
        // eq = Client::where('api_token',$request->api_token)->first();
        // Laravel Documentation - Authentication
        $loginUser->update($request->all());
        if ($request->has('password')) {
            $loginUser->password = bcrypt($request->password);
        }
        $loginUser->save();
        $data = [
            'client' => $request->user()->fresh()->load('city.governorate', 'bloodType')
        ];
        return responseJson(1, 'تم تحديث البيانات', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reset(Request $request): mixed
    {
        $validation = validator()->make($request->all(), [
            'phone' => 'required'
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $user = Client::where('phone', $request->phone)->first();
        if ($user) {
            $code = rand(1111, 9999);
            $update = $user->update(['pin_code' => $code]);
            if ($update) {
                // send sms
                // smsMisr($request->phone,"your reset code is : ".$code);
                // send email
                try {
                    $toEmailAddress = $user->email;
                    //      $client = Client::find($clientId);
                    Mail::to($toEmailAddress)
                        ->bcc("abdelhami12d@gmail.com")
                        ->send(new ResetPassword($code));

                } catch (Exception $e) {
                    \Logs::error("Unable to send email" . $e->getMessage());
                }
                return responseJson(1, 'برجاء تفقد الابمبل ',
                    [
                        'pin_code_for_test' => $code,
                        //             'mail_fails' => Mail::failures(),
                        'email' => $user->email,
                    ]);
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
            }
        } else {
            return responseJson(0, 'لا يوجد أي حساب مرتبط بهذا الهاتف');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function password(Request $request): mixed
    {
        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)
            ->where('phone', $request->phone)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;

            if ($user->save()) {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
            }
        } else {
            return responseJson(0, 'هذا الكود غير صالح');
        }
    }

    public function notificationsSettings(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'Notifications Settings']);
        $rules = [
            'governorates.*' => 'exists:governorates,id',
            'blood_types.*' => 'exists:blood_types,id',
        ];
        // governorates == [1,5,13]
        // blood_types == [1,3]
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        if ($request->has('governorates')) {
            // 1,2
            // sync (1,3,4)
            // 1,3,4

            $request->user()->governorate()->sync($request->governorates); // attach - detach() - toggle() - sync
        }

        if ($request->has('blood_types')) {
            $request->user()->bloodType()->sync($request->blood_types);
        }

        $data = [
            'governorates' => $request->user()->governorate()->pluck('governorates.id')->toArray(), // [1,3,4]
            // {name: asda , 'created' : asdasd , id: asdasd}
            // [1,5,13]
            'blood_types' => $request->user()->bloodType()->pluck('blood_types.id')->toArray(),
        ];
        return responseJson(1, 'تم  التحديث', $data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function registerToken(Request $request): JsonResponse
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
            'platform' => 'required|in:android,ios'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function removeToken(Request $request): JsonResponse
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();

        return responseJson(1, 'تم  الحذف  بنجاح');
    }

}
