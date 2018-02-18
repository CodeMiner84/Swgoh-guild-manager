<?php

namespace App\Factory;

use App\Entity\User;
use App\Entity\UserCharacter;

/**
 * Class UserCharacterFactory.
 */
class UserCharacterFactory
{
    /**
     * @param array $data
     *
     * @return UserCharacter
     */
    public static function create(array $data)
    {
        $user = new UserCharacter();
        $user
            ->setUser($data['user'])
            ->setCharacter($data['character'])
            ->setStars($data['stars'])
            ->setLevel($data['level'])
            ->setGear($data['gear'])
            ->setActive($data['active'])
            ->setPower($data['power'])
        ;

        return $user;
    }
}
