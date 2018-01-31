<?php

namespace App\Factory;

use App\Entity\Character;

/**
 * Class CharacterFactory
 *
 * @package App\Factory
 */
class CharacterFactory
{
    /**
     * @param array $data
     *
     * @return Character
     */
    public function create(array $data)
    {
        $character = new Character();
        $character->setCode($data['code'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setSide($data['side'])
            ->setImage($data['image'])
        ;

        return $character;
    }
}
