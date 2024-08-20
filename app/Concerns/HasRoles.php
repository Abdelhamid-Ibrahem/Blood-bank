<?php

namespace App\Concerns;
use App\models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasRoles {
     public function roles(): MorphToMany
     {
         return $this->morphToMany(Role::class , 'authorizable', 'role_user');
     }
     public function hasAbility($ability) {

         $allowed = $this->roles()->whereHas('abilities', function ($query) use ($ability) {
             $query->where( 'ability' , $ability)
                 ->where('type' , '=' , 'allow');
         })->exists();
         if ($allowed) {
             return true;
         }
         return  $this->roles()->whereHas('abilities', function ($query) use ($ability) {
             $query->where( 'ability' , $ability)
                 ->where('type' , '=' , 'deny');
         })->exists();


     }
}
