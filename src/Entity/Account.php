<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class Account implements UserInterface, \Serializable, EntityInterface
{
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $resetToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $resetTokenTime;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $enabled = true;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $guildId;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $guildCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $uuid;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="GuildSquad", mappedBy="account")
     */
    private $guildSquads;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @JMS\Groups({"account_show"})
     * @JMS\Expose
     */
    private $allyCode;

    /**
     * @ORM\OneToMany(targetEntity="UserCharacter", mappedBy="user")
     *
     * @JMS\Groups({"guild_users"})
     * @JMS\Expose
     */
    private $userCharacters;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        $this->guildSquads = new ArrayCollection();
        $this->userCharacters = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Admin
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        $this->username = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return Admin
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    /**
     * @param null|string $resetToken
     *
     * @return Admin
     */
    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;

        $this->setResetTokenTime(new DateTime());

        return $this;
    }

    /**
     * @return null|DateTime
     */
    public function getResetTokenTime(): ?DateTime
    {
        return $this->resetTokenTime;
    }

    /**
     * @param null|DateTime $resetTokenTime
     *
     * @return Admin
     */
    public function setResetTokenTime(?DateTime $resetTokenTime): self
    {
        $this->resetTokenTime = $resetTokenTime;

        return $this;
    }

    /**
     * @throws \Exception
     *
     * @return bool
     */
    public function isResetTokenValid(): bool
    {
        return !(null === $this->resetTokenTime || new DateTime() > $this->getResetTokenTime()->add(new \DateInterval('P7D'))
        );
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return Admin
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Returns the roles or permissions granted to the admin for security.
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     *
     * @return Account
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * Removes sensitive data from the admin.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        return serialize([$this->id, $this->username, $this->password]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        // add $this->salt too if you don't use Bcrypt or Argon2i
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return Account
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get enabled.
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set uuid.
     *
     * @param string $uuid
     *
     * @return Account
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid.
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Add guildSquad.
     *
     * @param GuildSquad $guildSquad
     *
     * @return Account
     */
    public function addGuildSquad(GuildSquad $guildSquad)
    {
        $this->guildSquads[] = $guildSquad;

        return $this;
    }

    /**
     * Remove guildSquad.
     *
     * @param GuildSquad $guildSquad
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeGuildSquad(GuildSquad $guildSquad)
    {
        return $this->guildSquads->removeElement($guildSquad);
    }

    /**
     * Get guildSquads.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuildSquads()
    {
        return $this->guildSquads;
    }

    /**
     * Set guildId.
     *
     * @param int $guildId
     *
     * @return Account
     */
    public function setGuildId($guildId)
    {
        $this->guildId = $guildId;

        return $this;
    }

    /**
     * Get guildId.
     *
     * @return int
     */
    public function getGuildId()
    {
        return $this->guildId;
    }

    /**
     * Set guildCode.
     *
     * @param string $guildCode
     *
     * @return Account
     */
    public function setGuildCode($guildCode)
    {
        $this->guildCode = $guildCode;

        return $this;
    }

    /**
     * Get guildCode.
     *
     * @return string
     */
    public function getGuildCode()
    {
        return $this->guildCode;
    }

    /**
     * @return string
     */
    public function getAllyCode(): string
    {
        return $this->allyCode;
    }

    /**
     * @param string $allyCode
     * @return Account
     */
    public function setAllyCode(string $allyCode): Account
    {
        $this->allyCode = $allyCode;

        return $this;
    }

    /**
     * Add userCharacter.
     *
     * @param \App\Entity\UserCharacter $userCharacter
     *
     * @return User
     */
    public function addUserCharacter(\App\Entity\UserCharacter $userCharacter)
    {
        $this->userCharacters;

        return $this;
    }

    /**
     * Remove userCharacter.
     *
     * @param \App\Entity\UserCharacter $userCharacter
     *
     * @return bool TRUE if this collection contained the specified element, FALSE otherwise
     */
    public function removeUserCharacter(\App\Entity\UserCharacter $userCharacter)
    {
        return $this->userCharacters->removeElement($userCharacter);
    }

    /**
     * Get userCharacters.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserCharacters()
    {
        return $this->userCharacters;
    }
}
