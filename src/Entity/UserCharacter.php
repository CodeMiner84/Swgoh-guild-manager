<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharacterRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class UserCharacter
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"guild_users"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     *
     * @JMS\Groups({"user_character", "guild_users"})
     * @JMS\Expose
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="Character", inversedBy="userCharacters", cascade={"persist"})
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"user_character", "guild_users"})
     * @JMS\Expose
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="userCharacters", cascade={"persist"})
     * @ORM\JoinColumn(fieldName="account_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_character"})
     * @JMS\Expose
     */
    private $stars;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_character"})
     * @JMS\Expose
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_character"})
     * @JMS\Expose
     */
    private $gear;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_character", "guild_users"})
     * @JMS\Expose
     */
    private $power;

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
     * Set stars.
     *
     * @param int $stars
     *
     * @return UserCharacter
     */
    public function setStars($stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get stars.
     *
     * @return int
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * Set gear.
     *
     * @param int $gear
     *
     * @return UserCharacter
     */
    public function setGear($gear)
    {
        $this->gear = $gear;

        return $this;
    }

    /**
     * Get gear.
     *
     * @return int
     */
    public function getGear()
    {
        return $this->gear;
    }

    /**
     * Set character.
     *
     * @param \App\Entity\Character|null $character
     *
     * @return UserCharacter
     */
    public function setCharacter(\App\Entity\Character $character = null)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * Get character.
     *
     * @return \App\Entity\Character|null
     *
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set account.
     *
     * @param \App\Entity\Account|null $account
     *
     * @return UserCharacter
     */
    public function setAccount(\App\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account.
     *
     * @return \App\Entity\Account|null
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return UserCharacter
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set level.
     *
     * @param int $level
     *
     * @return UserCharacter
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set power.
     *
     * @param int $power
     *
     * @return UserCharacter
     */
    public function setPower(int $power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power.
     *
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }
}
