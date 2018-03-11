<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountModsRepository")
 */
class AccountMods
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @ORM\Column(type="text")
     *
     * @JMS\Groups({"account_mods"})
     * @JMS\Expose
     */
    private $mods;

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
     * Set mods.
     *
     * @param string $mods
     *
     * @return AccountMods
     */
    public function setMods($mods)
    {
        $this->mods = $mods;

        return $this;
    }

    /**
     * Get mods.
     *
     * @return string
     */
    public function getMods()
    {
        return $this->mods;
    }

    /**
     * Set account.
     *
     * @param \App\Entity\Account|null $account
     *
     * @return AccountMods
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
}
