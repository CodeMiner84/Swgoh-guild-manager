<?php

namespace App\DataFixtures;

use App\Entity\Guild;
use App\Entity\Setting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadSettings.
 */
class LoadSettings extends Fixture
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->loadSettings();
        $this->loadGuild();
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        return [
            ['SWGOH', 'swgoh', 'https://swgoh.gg', '/u', '/g'],
        ];
    }

    /**
     * @return array
     */
    private function getGuildData(): array
    {
        return [
            ['Tears of Wrath', '20375', 'tears-of-wrath'],
        ];
    }

    private function loadSettings(): void
    {
        foreach ($this->getData() as [$title, $code, $api, $user, $guild]) {
            $setting = new Setting();
            $setting->setTitle($title)
                ->setCode($code)
                ->setApi($api)
                ->setUserSuffix($user)
                ->setGuildSuffix($guild);

            $this->manager->persist($setting);
            $this->addReference(sprintf('%s-api', $title), $setting);
        }

        $this->manager->flush();
    }

    private function loadGuild(): void
    {
        foreach ($this->getGuildData() as [$name, $uuid, $code]) {
            $setting = new Guild();
            $setting->setUuid($name)
                ->setUuid($uuid)
                ->setCode($code)
                ->setName($name);

            $this->manager->persist($setting);
            $this->addReference(sprintf('%s-guild', $code), $setting);
        }

        $this->manager->flush();
    }
}
