<?php

namespace App\Utils\API;

use App\Entity\Character;
use GuzzleHttp\Client;

class UnitData extends ApiConnector
{
    protected const API_URL = 'https://apiv2.swgoh.help/swgoh/data';

    public function fetchUnits()
    {
        $data = $this->getData();

        foreach ($data as $unit) {
            if ($unit->name === 'Asaj ventress') {
                die("!");
            }
            $name = $unit->name === 'Asaj ventress' ? 'Asaj ventress' : $unit->name;
            $character = $this->em->getRepository(Character::class)->findOneByName(strtolower($name));
            if ($character instanceof Character) {
                $character->setApiCode($unit->baseId);
            }
        }

        $this->em->flush();
    }

    private function getData()
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept'        => 'application/json',
            ];
            $client = $client->request('POST', self::API_URL, [
                'headers' => $headers,
                'form_params' => [
                    'collection' => 'unitsList',
                    'language' => 'eng_us'
                ]
            ]);

            return json_decode($client->getBody()->getContents());
        } catch (\Exception $e) {
            echo ($e->getMessage());die;
        }
    }
}
