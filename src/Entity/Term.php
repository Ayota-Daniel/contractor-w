<?php

namespace App\Entity;

use App\Repository\TermRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TermRepository::class)]
class Term
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $ref = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'terms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contract $contractId = null;

    #[ORM\OneToMany(mappedBy: 'termId', targetEntity: Supplication::class, orphanRemoval: true)]
    private Collection $supplications;

    public function __construct()
    {
        $this->supplications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getContractId(): ?Contract
    {
        return $this->contractId;
    }

    public function setContractId(?Contract $contractId): self
    {
        $this->contractId = $contractId;

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
            $supplication->setTermId($this);
        }

        return $this;
    }

    public function removeSupplication(Supplication $supplication): self
    {
        if ($this->supplications->removeElement($supplication)) {
            // set the owning side to null (unless already changed)
            if ($supplication->getTermId() === $this) {
                $supplication->setTermId(null);
            }
        }

        return $this;
    }
}
