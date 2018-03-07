<?php

namespace App\Factory;

use App\Entity\Character;
use App\Entity\Mod;
use App\Entity\ModType;

/**
 * Class ModTypeFactory.
 */
class ModTypeFactory
{
    /**
     * @param array $data
     *
     * @return ModType
     */
    public function create(array $data)
    {
        $modType = new ModType();
        $modType
            ->setType($data['type'])
            ->setKind($data['kind'])
            ->setMod($data['mod'])
            ->setName($data['name'])
            ->setValue($data['value'])
        ;

        return $modType;
    }
}
