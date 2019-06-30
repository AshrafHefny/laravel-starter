<?php

namespace App\Starter\BaseApp\Traits;

use App\Starter\Users\User;
use App\Starter\BaseApp\Models\Like;

/**
 * Manages model likes
 */
trait HasLikes
{
    /**
     * Get all of the model's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
    * Add a like for model by the given user.
    *
    * @param App\Starter\Users\User $user currently logged in user.
    * @return void
    */
    public function like(User $user)
    {
        $like = $this->getLike($user);

        if ($like) {
            return;
        }

        $this->likes()->create(['user_id' => $user->id]);
    }

    /**
     * Unlike by certain user
     * @param  App\Starter\Users\User $user
     * @return void
     */
    public function unlike(User $user)
    {
        $like = $this->getLike($user);

        if ($like) {
            $like->delete();
        }
    }

    /**
     * Check if model is liked by user
     * @param  App\Starter\Users\User $user
     * @return boolean
     */
    public function isLikedBy(User $user)
    {
        return (boolean) $this->getLike($user);
    }
    
    /**
     * Toggle user like
     * @param  App\Starter\Users\User $user
     * @return void
     */
    public function toggleLike(User $user)
    {
        $like = $this->getLike($user);

        if ($like) {
            $like->delete();
        } else {
            $this->likes()->create(['user_id' => $user->id]);
        }
    }
    
    /**
     * Get certain user related like
     * @param  App\Starter\Users\User $user
     * @return mixed
     */
    protected function getLike(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->first();
    }
}
