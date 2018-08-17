<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserSquadGroupRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class UserSquadGroup implements EntityInterface
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_squad_group"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(fieldName="account_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $account;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"user_squad_group"})
     * @JMS\Expose
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"user_squad_group"})
     * @JMS\Expose
     */
    private $type;

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
     * Set type.
     *
     * @param int $type
     *
     * @return UserSquadGroup
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}
