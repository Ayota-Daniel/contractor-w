<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $state = null;

    #[ORM\ManyToOne(inversedBy: 'contracts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userId = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'contractId', targetEntity: Signal::class)]
    private Collection $signals;

    #[ORM\OneToMany(mappedBy: 'contractId', targetEntity: Term::class, orphanRemoval: true)]
    private Collection $terms;

    #[ORM\OneToMany(mappedBy: 'contractId', targetEntity: Sign::class, orphanRemoval: true)]
    private Collection $signs;

    public function __construct()
    {
        $this->signals = new ArrayCollection();
        $this->terms = new ArrayCollection();
        $this->signs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $signal->setContractId($this);
        }

        return $this;
    }

    public function removeSignal(Signal $signal): self
    {
        if ($this->signals->removeElement($signal)) {
            // set the owning side to null (unless already changed)
            if ($signal->getContractId() === $this) {
                $signal->setContractId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Term>
     */
    public function getTerms(): Collection
    {
        return $this->terms;
    }

    public function addTerm(Term $term): self
    {
        if (!$this->terms->contains($term)) {
            $this->terms->add($term);
            $term->setContractId($this);
        }

        return $this;
    }

    public function removeTerm(Term $term): self
    {
        if ($this->terms->removeElement($term)) {
            // set the owning side to null (unless already changed)
            if ($term->getContractId() === $this) {
                $term->setContractId(null);
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
            $sign->setContractId($this);
        }

        return $this;
    }

    public function removeSign(Sign $sign): self
    {
        if ($this->signs->removeElement($sign)) {
            // set the owning side to null (unless already changed)
            if ($sign->getContractId() === $this) {
                $sign->setContractId(null);
            }
        }

        return $this;
    }
}
