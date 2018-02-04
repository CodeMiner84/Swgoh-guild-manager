<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 * @ORM\Table(name="characters")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"characters"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "user_character"})
     * @JMS\Expose
     */
    private $code = '';

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "user_character"})
     * @JMS\Expose
     */
    private $name = '';

    /**
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"characters", "user_character"})
     * @JMS\Expose
     */
    private $side = 0;

    /**
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"characters", "user_character"})
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
     * @ORM\Column(type="json_array")
     */
    private $tags = '';

    /**
     * @ORM\ManyToOne(targetEntity="UserCharacter", inversedBy="character")
     */
    private $userCharacter;

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
     * @param array $tags
     *
     * @return Character
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return array
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
}
