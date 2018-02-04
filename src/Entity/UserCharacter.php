<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCharacterRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class UserCharacter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     *
     * @JMS\Groups({"user_character"})
     * @JMS\Expose
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity="Character", inversedBy="userCharacters")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"user_character"})
     * @JMS\Expose
     */
    private $character;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="characters")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

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
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set user.
     *
     * @param \App\Entity\User|null $user
     *
     * @return UserCharacter
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \App\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
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
}
