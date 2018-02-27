<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSquadRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class UserSquad implements EntityInterface
{
    use TimestampableEntity;

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
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(fieldName="account_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity="UserSquadGroup")
     * @ORM\JoinColumn(fieldName="group_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $group;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"user_squad_list"})
     * @JMS\Expose
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="UserSquadCollection", mappedBy="userSquad")
     *
     * @JMS\Groups({"user_squad_list"})
     * @JMS\Expose
     */
    private $userSquadCollection;

    public function __construct()
    {
        $this->userSquadCollection = new ArrayCollection();
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
     * @return UserSquad
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
     * @return UserSquad
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
     * Set group.
     *
     * @param \App\Entity\UserSquadGroup|null $group
     *
     * @return UserSquad
     */
    public function setGroup(\App\Entity\UserSquadGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group.
     *
     * @return \App\Entity\UserSquadGroup|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Add userSquadCollection.
     *
     * @param \App\Entity\UserSquadCollection $userSquadCollection
     *
     * @return UserSquad
     */
    public function addUserSquadCollection(\App\Entity\UserSquadCollection $userSquadCollection)
    {
        $this->userSquadCollection[] = $userSquadCollection;

        return $this;
    }

    /**
     * Remove userSquadCollection.
     *
     * @param \App\Entity\UserSquadCollection $userSquadCollection
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeUserSquadCollection(\App\Entity\UserSquadCollection $userSquadCollection)
    {
        return $this->userSquadCollection->removeElement($userSquadCollection);
    }

    /**
     * Get userSquadCollection.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserSquadCollection()
    {
        return $this->userSquadCollection;
    }
}
