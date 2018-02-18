<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuildSquadRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class GuildSquad implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"guild_squad"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="guildSquads")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"guild_squad", "guild_squad_collection"})
     * @JMS\Expose
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @JMS\Groups({"guild_squad"})
     * @JMS\Expose
     */
    private $position;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @JMS\Groups({"guild_squad"})
     * @JMS\Expose
     */
    private $fullSquad = false;

    /**
     * @ORM\OneToMany(targetEntity="GuildSquadCollection", mappedBy="guildSquad")
     *
     * @JMS\Groups({"guild_squad"})
     * @JMS\Expose
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
     * Set name.
     *
     * @param string $name
     *
     * @return GuildSquad
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
     * Set position.
     *
     * @param int $position
     *
     * @return GuildSquad
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position.
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set account.
     *
     * @param Account|null $account
     *
     * @return GuildSquad
     */
    public function setAccount(Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account.
     *
     * @return Account|null
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Add guildSquadCollection.
     *
     * @param \App\Entity\GuildSquad $guildSquadCollection
     *
     * @return GuildSquad
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

    /**
     * Set fullSquad.
     *
     * @param bool $fullSquad
     *
     * @return GuildSquad
     */
    public function setFullSquad($fullSquad): self
    {
        $this->fullSquad = $fullSquad;

        return $this;
    }

    /**
     * Get fullSquad.
     *
     * @return bool
     */
    public function getFullSquad(): bool
    {
        return $this->fullSquad;
    }
}
