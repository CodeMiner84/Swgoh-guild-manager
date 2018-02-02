<?php

namespace App\Factory;

use App\Entity\User;

/**
 * Class UserFactory
 *
 * @package App\Factory
 */
class UserFactory
{
    /**
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        $user = new User();
        $user->setName($data['name'])
            ->setUuid($data['uuid'])
            ->setGuild($data['guild'])
            ;

        return $user;
    }
}
