<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id','publish_date');



    public function getThumbnailFullPathAttribute()
    {
        return asset($this->image);
    }
    //attribute IsFavourite -> is_favourite
    // $post->is_favourite [ true - false ]
    // if($post->is_favourite)

/*
    public function getIsFavouriteAttribute()
    {
        // الحصول على المستخدم الحالي من الحرس (Guard) المناسب
        $user = auth()->guard('client-web')->user() ?? auth()->guard('api')->user();

        // إذا لم يكن هناك مستخدم، إرجاع false
        if (!$user) {
            return false;
        }

       // التحقق من وجود عنصر مفضل مرتبط بالمستخدم الحالي
        $favourite = $this->favourites()
            ->where('clientable.clientable_type', get_class($user)) // نوع المفضل مرتبط بالنوع الصحيح (Client أو User)
            ->where('clientable.clientable_id', $user->id) // معرف المفضل مرتبط بالمستخدم
            ->exists(); // استخدام exists بدلاً من first لتحسين الأداء

        return $favourite;
    }

    public function getIsFavouriteAttribute()
    {

        $user = auth()->guard('client-web')->user() ?? auth()->guard('api')->user();
        if (!$user)
        {
            return false;
        }
       $favourite = $this->whereHas('favourites',function ($query) use($user){
            $query->where('clientable.clientable_type',$user->id);
            $query->where('clientable.clientable_type',$this->id);
        })->first();
        // client
        // null
        if ($favourite)
        {
            return true;
        }
        return false;
    }

*/
    public function favourites()
    {
        return $this->morphToMany(User::class,  'client_post','clientable');
    }
   /* public function favourites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Client');
    }
*/

    public function searchByKeyword($query,$request)
    {
        $query->where(function($post) use($request){
            $post->where('title','like','%'.$request->keyword.'%');
            $post->orWhere('content','like','%'.$request->keyword.'%');
        });
    }

    public function scopePublished($query)
    {
        $query->where('publish_date','<=',Carbon::now()->toDateString());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients(): MorphToMany
    {
        return $this->morphToMany('App\Models\Client', 'clientable"');
    }
   public static function rules()
   {
        return [
            'title' => 'required|string|min:3|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'publish_date' => 'required',
        ];
   }

}
