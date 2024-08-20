<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientable extends Model
{

    protected $table = 'clientables';
    public $timestamps = true;
    protected $fillable = array('client_id', 'clientable_id', 'clientable_type' );

    public function clients(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }



}
