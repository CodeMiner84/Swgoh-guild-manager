<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 *
 * @JMS\ExclusionPolicy("all")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"users", "guild"})
     * @JMS\Expose
     */
    private $uuid;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"users", "guild"})
     * @JMS\Expose
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Guild", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(name="guild_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $guild;

    /**
     * @ORM\OneToMany(targetEntity="Character", mappedBy="user")
     */
    private $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

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
     * Set uuid.
     *
     * @param string $uuid
     *
     * @return User
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set guild.
     *
     * @param Guild|null $guild
     *
     * @return User
     */
    public function setGuild(Guild $guild = null)
    {
        $this->guild = $guild;

        return $this;
    }

    /**
     * Get guild.
     *
     * @return Guild|null
     */
    public function getGuild()
    {
        return $this->guild;
    }

    /**
     * Add character.
     *
     * @param \App\Entity\Character $character
     *
     * @return User
     */
    public function addCharacter(\App\Entity\Character $character)
    {
        $this->characters[] = $character;

        return $this;
    }

    /**
     * Remove character.
     *
     * @param \App\Entity\Character $character
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeCharacter(\App\Entity\Character $character)
    {
        return $this->characters->removeElement($character);
    }

    /**
     * Get characters.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCharacters()
    {
        return $this->characters;
    }
}
