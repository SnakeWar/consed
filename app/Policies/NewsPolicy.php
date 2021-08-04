<?php

namespace App\Policies;

use App\User;
use App\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function view(User $user, News $news)
    {
        return $user->type === 'administrador';
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function update(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function delete(User $user, News $news)
    {
        //
    }

    /**
     * Determine whether the user can restore the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function restore(User $user, News $news)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the news.
     *
     * @param  \App\User  $user
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function forceDelete(User $user, News $news)
    {
        //
    }
}
