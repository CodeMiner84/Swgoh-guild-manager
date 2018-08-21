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
            ->setAccount($data['account'])
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
