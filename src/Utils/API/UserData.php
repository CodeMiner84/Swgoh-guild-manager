<?php

namespace App\Utils\API;

use App\Entity\Account;
use App\Entity\Character;
use App\Entity\User;
use App\Entity\UserCharacter;
use App\Factory\UserCharacterFactory;
use App\Utils\CharacterCrawler;
use GuzzleHttp\Client;

class UserData extends ApiConnector
{
    protected const API_URL = 'https://apiv2.swgoh.help/swgoh/units';

    public function fetchUser(string $allyCode)
    {
        $data = $this->getData($allyCode);

        $account = $this->em->getRepository(Account::class)->findOneByAllyCode($allyCode);
        foreach ($data as $apiCode => $unit) {
            $unit = current($unit);
            $character = $this->em->getRepository(Character::class)->findOneByApiCode($apiCode);
            if (!$character instanceof Character) {
                continue;
            }

            $data = [
                'stars' => $unit->starLevel,
                'account' => $account,
                'character' => $character,
                'active' => true,
                'level' => $unit->level,
                'gear' => $unit->gearLevel,
                'power' => $unit->gp,
            ];

            if ($this->characterExists($account, $character)) {
                $this->em->getRepository(UserCharacter::class)->updateToon($account, $data);
            } else {
                $this->em->persist(UserCharacterFactory::create($data));
            }
        }

        $this->em->flush();
    }

    /**
     * @param Account      $account
     * @param Character $character
     *
     * @return int
     */
    public function characterExists(Account $account, Character $character)
    {
        return $this->em->getRepository(UserCharacter::class)->findOneBy([
            'account' => $account,
            'character' => $character,
        ]);
    }

    /**
     * @param string $allyCode
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getData(string $allyCode)
    {
        $params = [
            'allycode' => $allyCode,
            'mods' => true,
        ];

        return $this->getResource(self::API_URL, $params);
    }
}
