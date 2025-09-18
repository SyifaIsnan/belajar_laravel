<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    use HasFactory;
    protected $table = "posts";

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_published',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post_log(){
        return $this->hasOne(PostLogsModel::class);
    }

}
