<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModTypeRepository")
 * @ORM\Table(name="user_mod_type")
 */
class ModType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mod", inversedBy="types")
     * @ORM\JoinColumn(name="mod_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $mod;

    /**
     * @ORM\Column(type="boolean")
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $kind;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $value;



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
     * Set type.
     *
     * @param bool $type
     *
     * @return ModType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set kind.
     *
     * @param bool $kind
     *
     * @return ModType
     */
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get kind.
     *
     * @return bool
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return ModType
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
     * Set value.
     *
     * @param string $value
     *
     * @return ModType
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set mod.
     *
     * @param \App\Entity\Mod|null $mod
     *
     * @return ModType
     */
    public function setMod(\App\Entity\Mod $mod = null)
    {
        $this->mod = $mod;

        return $this;
    }

    /**
     * Get mod.
     *
     * @return \App\Entity\Mod|null
     */
    public function getMod()
    {
        return $this->mod;
    }
}
