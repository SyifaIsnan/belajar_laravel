<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLogsModel extends Model
{
    use HasFactory;

    protected $table = 'post_logs';

    protected $fillable = [
        'action',
        'post_id',
        'user_id',
        'changes',
        
    ];

    public function post(){
        return $this->belongsTo(PostsModel::class);
    }

     public function user(){
        return $this->belongsTo(User::class);
    }
}
