<?php

declare(strict_types=1);

namespace Modules\UI\Contracts;

/**
 * This interface allows models to receive replies.
 */
interface HasLikeContract
{
    /**
     * @param \Modules\User\Models\User|null $user
     *
     * @return bool
     */
    public function isLikedBy($user);

    /**
     * @param \Modules\User\Models\User|null $user
     *
     * @return void
     */
    public function likedBy($user);

    /**
     * @param \Modules\User\Models\User|null $user
     *
     * @return void
     */
    public function dislikedBy($user);
}
