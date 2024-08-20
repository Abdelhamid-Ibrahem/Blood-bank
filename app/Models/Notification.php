<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'donation_request_id');

    public function donationRequest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany('App\Models\Client', 'clientable')->withPivot('is_read');;
    }

}
