<?php

namespace App\Factory;

use App\Entity\Character;

/**
 * Class CharacterFactory.
 */
class CharacterFactory
{
    /**
     * @param array $data
     *
     * @return Character
     */
    public static function create(array $data): Character
    {
        $character = new Character();
        $character->setCode($data['code'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setSide($data['side'])
            ->setImage($data['image'])
            ->setTags($data['tags'])
        ;

        return $character;
    }
}
