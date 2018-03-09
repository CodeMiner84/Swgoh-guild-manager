<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="characters")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Character
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"characters", "guild_squad", "guild_squad_collection", "guild_users", "user_squad_list"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "guild_squad", "user_character", "guild_squad_collection", "guild_users", "user_squad_list"})
     * @JMS\Expose
     */
    private $code = '';

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "guild_squad", "user_character", "guild_squad_collection", "guild_users", "user_squad_list"})
     * @JMS\Expose
     */
    private $name = '';

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"characters", "guild_squad", "user_character", "guild_squad_collection", "user_squad_list"})
     * @JMS\Expose
     */
    private $side = 0;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "guild_squad", "user_character", "guild_squad_collection", "user_squad_list"})
     * @JMS\Expose
     */
    private $image = '';

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "user_character"})
     * @JMS\Expose
     */
    private $description = '';

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters"})
     * @JMS\Expose
     */
    private $tags = '';

    /**
     * @ORM\ManyToOne(targetEntity="UserCharacter", inversedBy="character")
     */
    private $userCharacter;

    /**
     * @ORM\OneToMany(targetEntity="GuildSquad", mappedBy="character")
     */
    private $guildSquadCollection;

    public function __construct()
    {
        $this->guildSquadCollection = new ArrayCollection();
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
     * Set code.
     *
     * @param string $code
     *
     * @return Character
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
     * Set name.
     *
     * @param string $name
     *
     * @return Character
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
     * Set side.
     *
     * @param int $side
     *
     * @return Character
     */
    public function setSide($side)
    {
        $this->side = $side;

        return $this;
    }

    /**
     * Get side.
     *
     * @return int
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Set image.
     *
     * @param string $image
     *
     * @return Character
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Character
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags.
     *
     * @param string $tags
     *
     * @return Character
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set userCharacter.
     *
     * @param \App\Entity\UserCharacter|null $userCharacter
     *
     * @return Character
     */
    public function setUserCharacter(\App\Entity\UserCharacter $userCharacter = null)
    {
        $this->userCharacter = $userCharacter;

        return $this;
    }

    /**
     * Get userCharacter.
     *
     * @return \App\Entity\UserCharacter|null
     */
    public function getUserCharacter()
    {
        return $this->userCharacter;
    }

    /**
     * Add guildSquadCollection.
     *
     * @param \App\Entity\GuildSquad $guildSquadCollection
     *
     * @return Character
     */
    public function addGuildSquadCollection(\App\Entity\GuildSquad $guildSquadCollection)
    {
        $this->guildSquadCollection[] = $guildSquadCollection;

        return $this;
    }

    /**
     * Remove guildSquadCollection.
     *
     * @param \App\Entity\GuildSquad $guildSquadCollection
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeGuildSquadCollection(\App\Entity\GuildSquad $guildSquadCollection)
    {
        return $this->guildSquadCollection->removeElement($guildSquadCollection);
    }

    /**
     * Get guildSquadCollection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuildSquadCollection()
    {
        return $this->guildSquadCollection;
    }
}
