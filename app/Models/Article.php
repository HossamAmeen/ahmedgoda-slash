<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Article extends Model
{
    use SoftDeletes;

    
    protected $fillable = [
        'title' ,'type','description', 'en_title' ,
         'en_description', 'image' , "user_id"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
