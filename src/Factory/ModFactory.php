<?php

namespace App\Factory;

use App\Entity\Character;
use App\Entity\Mod;

/**
 * Class ModFactory.
 */
class ModFactory
{
    /**
     * @param array $data
     *
     * @return Mod
     */
    public function create(array $data)
    {
        $mod = new Mod();
        $mod->setImage($data['image'])
            ->setName($data['name'])
            ->setCharacter($data['character'])
            ->setAccount($data['account'])
            ->setUser($data['user'])
            ->setType($data['type'])
            ->setSlot($data['slot'])
            ->setUuid($data['uuid'])
        ;

        return $mod;
    }
}
