<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name', 'id');


    public function client(): MorphToMany
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }
    public function donationRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}
