<?php

namespace App\Observers;

use App\Models\PostLogsModel;
use App\Models\PostsModel;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    /**
     * Handle the PostsModel "created" event.
     */
    public function created(PostsModel $postsModel): void
    {
         PostLogsModel::create([
            "post_id"=>$postsModel->id,
            "action"=>"created post",
            "changes"=>[
                "name"=>$postsModel->title,
                "content"=>$postsModel->content
            ],
            "user_id"=>Auth::id()
        ]);
    }

    /**
     * Handle the PostsModel "updated" event.
     */
    public function updated(PostsModel $postsModel): void
    {
       //
    }

    /**
     * Handle the PostsModel "deleted" event.
     */
    public function deleted(PostsModel $postsModel): void
    {
        //
    }

    /**
     * Handle the PostsModel "restored" event.
     */
    public function restored(PostsModel $postsModel): void
    {
        //
    }

    /**
     * Handle the PostsModel "force deleted" event.
     */
    public function forceDeleted(PostsModel $postsModel): void
    {
        //
    }
}
