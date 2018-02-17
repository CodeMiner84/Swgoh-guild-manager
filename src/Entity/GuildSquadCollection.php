<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuildSquadCollectionRepository")
 */
class GuildSquadCollection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"guild_squad_collection"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GuildSquad", inversedBy="guildSquadCollection")
     * @ORM\JoinColumn(name="guild_squad_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"guild_squad_collection"})
     * @JMS\Expose
     */
    private $guildSquad;

    /**
     * @ORM\ManyToOne(targetEntity="Character", inversedBy="guildSquadCollection")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @JMS\Groups({"guild_squad_collection", "guild_squad"})
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
     * Set guildSquad.
     *
     * @param \App\Entity\GuildSquad|null $guildSquad
     *
     * @return GuildSquadCollection
     */
    public function setGuildSquad(\App\Entity\GuildSquad $guildSquad = null)
    {
        $this->guildSquad = $guildSquad;

        return $this;
    }

    /**
     * Get guildSquad.
     *
     * @return \App\Entity\GuildSquad|null
     */
    public function getGuildSquad()
    {
        return $this->guildSquad;
    }

    /**
     * Set character.
     *
     * @param \App\Entity\Character|null $character
     *
     * @return GuildSquadCollection
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
