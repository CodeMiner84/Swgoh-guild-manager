<?php

namespace App\Factory;

use App\Entity\Guild;

/**
 * Class GuildFactory.
 */
class GuildFactory
{
    /**
     * @param array $data
     *
     * @return Guild
     */
    public function create(array $data)
    {
        $guild = new Guild();
        $guild
            ->setCode($data['code'])
            ->setUuid($data['uuid'])
            ->setName($data['name'])
        ;

        return $guild;
    }
}
