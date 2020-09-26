<?php

namespace FreedomSex\ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="auth_user")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=36)
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=101)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=101)
     */
    private $password;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $grants = [];

    /**
     * @ORM\Column(name="`subject`", type="string", length=20)
     */
    private $subject;

    /**
     * @ORM\Column(type="smallint")
     */
    private $errors = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $iphash;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email = '';

    /**
     * @ORM\Column(type="datetime")
     */
    private $added;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;


    /** @ORM\PrePersist */
    public function prePersist()
    {
        $this->errors = 0;
        $this->added = new \DateTime();
        $this->updated = $this->added;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getErrors(): ?int
    {
        return $this->errors;
    }

    public function setErrors(int $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function getIphash(): ?string
    {
        return $this->iphash;
    }

    public function setIphash(string $iphash): self
    {
        $this->iphash = $iphash;

        return $this;
    }

    public function getAdded(): ?\DateTimeInterface
    {
        return $this->added;
    }

    public function setAdded(\DateTimeInterface $added): self
    {
        $this->added = $added;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }


    public function getRoles(): ?array
    {
        $roles = $this->roles ?? [];
        $roles[] = 'ROLE_USER';
        $roles = array_unique($roles);
        return array_values($roles);
    }

    public function getGrants(): ?array
    {
        return $this->grants ?? [];
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }

    public function resetRoles(string $role): self
    {
        $roles = ['ROLE_USER'];
        $roles[] = strtoupper($role);
        $roles = array_merge($roles, $this->getGrants());
        $roles = array_unique($roles);
        $this->roles = array_values($roles);

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
