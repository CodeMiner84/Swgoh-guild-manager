<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSquadCollectionRepository")
 */
class UserSquadCollection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_squad_list"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserSquad", inversedBy="userSquadCollection")
     * @ORM\JoinColumn(name="user_squad_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"user_squad_list"})
     * @JMS\Expose
     */
    private $userSquad;

    /**
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"user_squad_list"})
     * @JMS\Expose
     */
    private $character;

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
     * Set userSquad.
     *
     * @param \App\Entity\UserSquad|null $userSquad
     *
     * @return UserSquadCollection
     */
    public function setUserSquad(\App\Entity\UserSquad $userSquad = null)
    {
        $this->userSquad = $userSquad;

        return $this;
    }

    /**
     * Get userSquad.
     *
     * @return \App\Entity\UserSquad|null
     */
    public function getUserSquad()
    {
        return $this->userSquad;
    }

    /**
     * Set character.
     *
     * @param \App\Entity\Character|null $character
     *
     * @return UserSquadCollection
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
}
