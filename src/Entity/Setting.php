<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingRepository")
 * @ORM\Table(name="setting")
 */
class Setting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title = '';

    /**
     * @ORM\Column(type="string")
     */
    private $code = '';

    /**
     * @ORM\Column(type="string")
     */
    private $api = '';

    /**
     * @ORM\Column(type="string")
     */
    private $userSuffix = '';

    /**
     * @ORM\Column(type="string")
     */
    private $guildSuffix = '';

    /**
     * @ORM\Column(type="string")
     */
    private $unitSuffix = '';

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Setting
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set api.
     *
     * @param string $api
     *
     * @return Setting
     */
    public function setApi($api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Get api.
     *
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set userSuffix.
     *
     * @param string $userSuffix
     *
     * @return Setting
     */
    public function setUserSuffix($userSuffix)
    {
        $this->userSuffix = $userSuffix;

        return $this;
    }

    /**
     * Get userSuffix.
     *
     * @return string
     */
    public function getUserSuffix()
    {
        return $this->userSuffix;
    }

    /**
     * Set guildSuffix.
     *
     * @param string $guildSuffix
     *
     * @return Setting
     */
    public function setGuildSuffix($guildSuffix)
    {
        $this->guildSuffix = $guildSuffix;

        return $this;
    }

    /**
     * Get guildSuffix.
     *
     * @return string
     */
    public function getGuildSuffix()
    {
        return $this->guildSuffix;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Setting
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getUnitSuffix()
    {
        return $this->unitSuffix;
    }

    /**
     * @param string $unitSuffix
     */
    public function setUnitSuffix($unitSuffix): self
    {
        $this->unitSuffix = $unitSuffix;

        return $this;
    }
}
