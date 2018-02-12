<?php

namespace App\Entity;

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
     *
     * @JMS\Groups({"guild_squad"})
     * @JMS\Expose
     */
    private $account;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"guild_squad"})
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
}
