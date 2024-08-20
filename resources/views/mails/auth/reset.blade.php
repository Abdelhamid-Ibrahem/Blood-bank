@php use App\Mail\ResetPassword;use App\Http\Controllers\Api\AuthController;use Illuminate\Database\Eloquent\Model;use Illuminate\Http\Resources\Json\JsonResource;use Illuminate\Mail\Mailable; @endphp
<x-mail::message>
    # Introduction
    Blood Bank Reset Password .

    <p>Your reset code is :</p>

         {{ $code }}

    Thanks,<br>
    {{ config('app.name') }}

</x-mail::message>
