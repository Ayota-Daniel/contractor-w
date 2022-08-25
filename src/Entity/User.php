<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?string $compteId = null;

    #[ORM\Column(length: 25)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Contract::class)]
    private Collection $contracts;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Signal::class)]
    private Collection $signals;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Supplication::class, orphanRemoval: true)]
    private Collection $supplications;

    #[ORM\OneToMany(mappedBy: 'userId', targetEntity: Sign::class)]
    private Collection $signs;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
        $this->signals = new ArrayCollection();
        $this->supplications = new ArrayCollection();
        $this->signs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCompteId(): ?string
    {
        return $this->compteId;
    }

    public function setCompteId(string $compteId): self
    {
        $this->compteId = $compteId;

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

    /**
     * @return Collection<int, Contract>
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts->add($contract);
            $contract->setUserId($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getUserId() === $this) {
                $contract->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Signal>
     */
    public function getSignals(): Collection
    {
        return $this->signals;
    }

    public function addSignal(Signal $signal): self
    {
        if (!$this->signals->contains($signal)) {
            $this->signals->add($signal);
            $signal->setUserId($this);
        }

        return $this;
    }

    public function removeSignal(Signal $signal): self
    {
        if ($this->signals->removeElement($signal)) {
            // set the owning side to null (unless already changed)
            if ($signal->getUserId() === $this) {
                $signal->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Supplication>
     */
    public function getSupplications(): Collection
    {
        return $this->supplications;
    }

    public function addSupplication(Supplication $supplication): self
    {
        if (!$this->supplications->contains($supplication)) {
            $this->supplications->add($supplication);
            $supplication->setUserId($this);
        }

        return $this;
    }

    public function removeSupplication(Supplication $supplication): self
    {
        if ($this->supplications->removeElement($supplication)) {
            // set the owning side to null (unless already changed)
            if ($supplication->getUserId() === $this) {
                $supplication->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sign>
     */
    public function getSigns(): Collection
    {
        return $this->signs;
    }

    public function addSign(Sign $sign): self
    {
        if (!$this->signs->contains($sign)) {
            $this->signs->add($sign);
            $sign->setUserId($this);
        }

        return $this;
    }

    public function removeSign(Sign $sign): self
    {
        if ($this->signs->removeElement($sign)) {
            // set the owning side to null (unless already changed)
            if ($sign->getUserId() === $this) {
                $sign->setUserId(null);
            }
        }

        return $this;
    }
}
