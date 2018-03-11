<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModRepository")
 * @ORM\Table(name="user_mod")
 */
class Mod
{
    use TimestampableEntity;

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
     * @ORM\OneToMany(targetEntity="ModType", mappedBy="mod")
     */
    private $tpes;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumn(name="character_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $character;

    /**
     * @ORM\Column(type="string")
     */
    private $image = '';

    /**
     * @ORM\Column(type="string")
     */
    private $name = '';

    public function __construct()
    {
        $this->types = new ArrayCollection();
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
     * Set image.
     *
     * @param string $image
     *
     * @return Mod
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
     * Set name.
     *
     * @param string $name
     *
     * @return Mod
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
     * Set account.
     *
     * @param \App\Entity\Account|null $account
     *
     * @return Mod
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
     * Set user.
     *
     * @param \App\Entity\User|null $user
     *
     * @return Mod
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
     * Set character.
     *
     * @param \App\Entity\Character|null $character
     *
     * @return Mod
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
     * Add tpe.
     *
     * @param \App\Entity\ModType $tpe
     *
     * @return Mod
     */
    public function addTpe(\App\Entity\ModType $tpe)
    {
        $this->tpes[] = $tpe;

        return $this;
    }

    /**
     * Remove tpe.
     *
     * @param \App\Entity\ModType $tpe
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeTpe(\App\Entity\ModType $tpe)
    {
        return $this->tpes->removeElement($tpe);
    }

    /**
     * Get tpes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTpes()
    {
        return $this->tpes;
    }
}
