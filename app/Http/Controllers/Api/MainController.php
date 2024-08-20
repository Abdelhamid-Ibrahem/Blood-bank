<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\City;
use App\Models\Logs;
use App\Models\Token;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function posts(Request $request): JsonResponse
    {
        // Start Query with relation
        $query = Post::with('category');

        //
        if   ($request->input('category_id')) {
            $query->where('category_id', $request->category_id);

            if ($request->input('keyword')) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('name', 'like', '%' . $request->keyword . '%');
                });
            }
        }

        // تطبيق نطاق البحث بالكلمة المفتاحية إذا تم توفير الكلمة المفتاحية
        if ($request->input('keyword')) {

            $query->searchByKeyword($request->keyword);
        }

        // ترتيب النتائج وتطبيق الترقيم
        $posts = $query->latest()->paginate(20);

        // تسجيل الطلب في السجل
        Logs::create(['content' => json_encode($request->all()), 'service' => 'posts']);

        // إرجاع استجابة JSON
        return responseJson(1, 'success', $posts);
    }

    /*-
    public function posts(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'post details']);
        $post = Post::with('category')->find($request->post_id);
        if (!$post) {
            return responseJson(0, '404 no post found');
        }
        return responseJson(1, 'success', $post);

        $posts = Post::with('category')->query();
        if ($request->input('category_id')) {
            $posts = $posts->where('category_id', $request->category_id);
            $posts->whereHas('category', function ($category) use ($request) {
                $category->where('name', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->input('keyword')) {

            $posts = $posts->searchByKeyword($request);
        }
        $posts = $posts->latest()->paginate(20);
        Logs::create(['content' => $request->all(), 'service' => 'posts']);
        with('relation_name');
        //       load('city') lazy eager loading;
        //    $posts = Post::with('category')->where(function($post) use($request) {
        //       if ($request->category_id) {
        //           $post->where('category_id', $request->category_id);
        //     }
        //    if ($request->keyword)
        //      {
        //           // scope
        //           $post->searchByKeyword($request);
        //      }
        //    })->latest()->paginate(20);
        return responseJson(1, 'success', $posts);

    }
-*/
    public function governorates(): JsonResponse
    {
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }

    public function cities(Request $request): JsonResponse
    {
        $cities = city::where(function ($query) use ($request) {
            if ($request->has('governorate_id')) {
                $query->where('governorate_id', $request->governorate_id);
            }
        })->get();
        return responseJson(1, 'success', $cities);
    }

    public function settings(): JsonResponse
    {
        return responseJson(1, 'loaded', settings());
    }

    public function contact(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'contact us']);
        $rules = [
            'title' => 'required',
            'message' => 'required',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $contact = $request->user()->contacts()->create($request->all());
        return responseJson(1, 'تم الارسال', $contact);
    }

    public function bloodTypes(): JsonResponse
    {
        $bloodTypes = bloodType::all();
        return responseJson(1, 'success', $bloodTypes);
    }

    public function categories(): JsonResponse
    {
        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }
    public function postFavourite(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'post toggle favourite']);
        $rules = [
            'post_id' => 'required|exists:posts,id',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $toggle = $request->user()->Favourites()->toggle($request->post_id);
        // attach() detach() sync() toggle()
        // [1,2,4] - sync(2,5,7) -> [1,2,4,5,7]
        // detach()
        // attach([2,5,7])

        return responseJson(1, 'Success', $toggle);
    }
    public function myFavourites(Request $request): JsonResponse
    {
        $posts = $request->user()->Favourites()->with('category')->latest()->paginate(20); // ->toSql ->paginate(20);// oldest()
        // ->get() ->first() ->find(3) ->all() ||| ->toSql();
        return responseJson(1, 'Loaded...', $posts);
    }
    public function logs()
    {
        $query = Logs::latest()->paginate(50);
        return $query;
    }
    public function donationRequests(Request $request)
    {
        Logs::create(['content' => $request->all(), 'service' => 'donation details']);
        $donation = DonationRequest::with('city', 'client', 'bloodType')->find($request->donation_id);
        if (!$donation) {
            return responseJson(0, '404 no donation found');
        }

        if ($request->user()->notifications()->where('donation_request_id', $donation->id)->first()) {
            $request->user()->notifications()->updateExistingPivot($donation->notification->id, [
                'is_read' => 1
            ]);
        }
    }
    public function donationRequestCreate(Request $request): JsonResponse
    {
        // validation
        Logs::create(['content' => $request->all(), 'service' => 'donation create']);
        $rules = [
            'patient_name' => 'required',
            'patient_age' => 'required:digits',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required:digits',
            'hospital_address' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required|digits:11',
            'client_id'=> 'required|exists:clients,id',
            'hospital_name'=> 'required',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        // create donation request
        // $request->user() // according to middleware guard (web - api)
        // Auth::user() default web
        // auth()->user() default web
        // auth()->guard('api')->user()   // auth is optional
        // auth('api')->user()
        $donationRequest = $request->user()->DonationRequest()->create($request->all());

        $clientsIds = $donationRequest->city->governorate->clients()
            ->whereHas('bloodType', function ($q) use ($request,$donationRequest) {
                $q->where('blood_types.id', $donationRequest->blood_type_id);
            })

            ->pluck('clients.id')->toArray();

        $send = "";
        if (count($clientsIds)) {
            // create a notification on database
            $notification = $donationRequest->notifications()->create([
                'title' => 'يوجد حالة تبرع قريبة منك',
                'content' => $donationRequest->blood_type_id . 'محتاج متبرع لفصيلة ',
            ]);
            // attach clients to this notification
            $notification->clients()->attach($clientsIds);

            // android - account firebase FCM
            // access key
            // register device - FCM token
            // send to api (token - platform [android - ios] - api_token)
            // store token - tokens [token - platform(ENUM) - client_id] table

            // 2 services : register token - remove token

            $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();

            if (count($tokens))
            {
                $title = $notification->title;
                $body = $notification->content;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
                //Artisan::call('config:clear');
                $send = json_decode($send);
            }

        }

        return responseJson(1, 'تم الاضافة بنجاح', $donationRequest->load('client','city'));

    }

    public function notificationsCount(Request $request): JsonResponse
    {
        $count = $request->user()->notifications()->where(function ($query) use ($request) {

            $query->where('is_read',0);

        })->count();
        return responseJson(1, 'loaded...',[
            'notifications-count' => $count
        ]);
        // 'notifications_count' => $request->user()->notifications()->count()

    }

    public function notifications(Request $request): JsonResponse
    {
        $items = $request->user()->notifications()->latest()->paginate(20);
        return responseJson(1, 'Loaded...', $items);
    }


    public function report(Request $request): JsonResponse
    {
        Logs::create(['content' => $request->all(), 'service' => 'report']);
        $rules = [
            'message' => 'required',
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $report = $request->user()->reports()->create($request->all());
        return responseJson(1, 'تم الارسال', $report);
    }

    public function testNotification(Request $request): JsonResponse
    {
//        $audience = ['included_segments' => array('All')];
//        if ($request->has('ids'))
//        {
//            $audience = ['include_player_ids' => (array)$request->ids];
//        }
//        $contents = ['en' => $request->title];
//        Log::info('test notification');
//        Log::info(json_encode($audience));
//        $send = notifyByOneSignal($audience , $contents , $request->data);
//        Log::info($send);

        /*
        firebase
        */
        $tokens = $request->ids;
        $title = $request->title;
        $body = $request->body;
        $data = DonationRequest::first();
        $send = notifyByFirebase($title, $body, $tokens, $data);
        info("firebase result: " . $send);

        return response()->json([
            'status' => 1,
            'msg' => 'تم الارسال بنجاح',
            'send' => json_decode($send)
        ]);
    }



}


