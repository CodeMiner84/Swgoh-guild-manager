<?php

namespace App\DataFixtures;

use App\Entity\Guild;
use App\Entity\Setting;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

/**
 * Class LoadSettings
 * @package App\DataFixtures
 */
class LoadSettings extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadSettings($manager);
        $this->loadGuild($manager);
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            ['SWGOH', 'swgoh', 'https://swgoh.gg', '/u', '/g']
        ];
    }

    /**
     * @return array
     */
    private function getGuildData(): array
    {
        return [
            ['Tears of Wrath', '20375', 'tears-of-wrath']
        ];
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadSettings(ObjectManager $manager): void
    {
        foreach ($this->getData() as [$title, $code, $api, $user, $guild]) {
            $setting = new Setting();
            $setting->setTitle($title)
                ->setCode($code)
                ->setApi($api)
                ->setUserSuffix($user)
                ->setGuildSuffix($guild);

            $manager->persist($setting);
            $this->addReference(sprintf("%s-api", $title), $setting);
        }

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadGuild(ObjectManager $manager): void
    {
        foreach ($this->getGuildData() as [$title, $uuid, $code]) {
            $setting = new Guild();
            $setting->setUuid($title)
                ->setUuid($uuid)
                ->setCode($code)
                ->setTitle($title);

            $manager->persist($setting);
            $this->addReference(sprintf("%s-guild", $code), $setting);
        }

        $manager->flush();
    }
}
