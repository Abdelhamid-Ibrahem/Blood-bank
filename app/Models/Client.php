<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use hasApiTokens, Notifiable
        , HasRoles;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'password',  'name', 'birth_date',  'last_donation', 'city_id', 'pin_code','blood_type','blood_type_id', 'is_active');

  /*  public function bloodType(): MorphToMany
    {
        return $this->morphedByMany('App\Models\BloodType', 'Clientable');
    }  */

    public function favourites(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Post', 'Clientable');
    }
    public function City(): BelongsTo
    {
        return $this->belongsTo('App\Models\City');
    }
    public function tokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Token');
    }
    public function notificationTokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NotificationToken::class);
    }

    protected $hidden = [
        'password','api_token'
    ];
    public function bloodType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\BloodType');
    }
    public function donationRequest(): MorphToMany
    {
        return $this->morphedByMany('App\Models\DonationRequest', 'clientable');
    }

    public function post(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function governorate(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }
    public function notifications(): MorphToMany
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }
    public function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Report');
    }
}
