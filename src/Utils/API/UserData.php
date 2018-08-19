<?php

namespace App\Utils\API;

use App\Entity\Character;
use GuzzleHttp\Client;

class UserData extends ApiConnector
{
    protected const API_URL = 'https://apiv2.swgoh.help/swgoh/units';

    public function fetchUser(string $allyCode)
    {
        var_dump($allyCode);
        var_dump($this->accessToken);

        $data = $this->getData($allyCode);


        $toons = [];
        foreach ($data as $characterCode => $character) {
            //var_dump($characterCode);
            $toons[$characterCode] = $characterCode;
        }
        $existed = $this->em->getRepository(Character::class)->findAll();

        var_dump(count($toons));
        foreach ($existed as $item) {
            if (isset($toons[$item->getApiCode()])) {
                //var_dump($item->getCode());
                unset($toons[$item->getApiCode()]);
            }
        }
        var_dump(count($toons));
        var_dump($toons);die;
        die;
        var_dump($this->getData($allyCode));
        die;
        die;
    }

    private function getData(string $allyCode)
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
                    'allycode' => $allyCode,
                    'mods' => true,
                ]
            ]);

            return json_decode($client->getBody()->getContents());
        } catch (\Exception $e) {
            echo ($e->getMessage());die;
        }
    }
}
