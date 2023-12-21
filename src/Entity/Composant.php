<?php

namespace App\Entity;

use App\Repository\ComposantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComposantRepository::class)]
class Composant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $label = null;

    #[ORM\Column]
    private ?float $adressex = null;

    #[ORM\Column]
    private ?float $adressey = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'composants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?illustration $illus_id = null;

    #[ORM\OneToMany(mappedBy: 'labelorig', targetEntity: Traduction::class)]
    private Collection $traductions;

    #[ORM\OneToMany(mappedBy: 'composant_id', targetEntity: Traduction::class, orphanRemoval: true)]
    private Collection $traductions_id;

    public function __construct()
    {
        $this->traductions = new ArrayCollection();
        $this->traductions_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getAdressex(): ?float
    {
        return $this->adressex;
    }

    public function setAdressex(float $adressex): static
    {
        $this->adressex = $adressex;

        return $this;
    }

    public function getAdressey(): ?float
    {
        return $this->adressey;
    }

    public function setAdressey(float $adressey): static
    {
        $this->adressey = $adressey;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIllusId(): ?illustration
    {
        return $this->illus_id;
    }

    public function setIllusId(?illustration $illus_id): static
    {
        $this->illus_id = $illus_id;

        return $this;
    }

    /**
     * @return Collection<int, Traduction>
     */
    public function getTraductions(): Collection
    {
        return $this->traductions;
    }

    public function addTraduction(Traduction $traduction): static
    {
        if (!$this->traductions->contains($traduction)) {
            $this->traductions->add($traduction);
            $traduction->setLabelorig($this);
        }

        return $this;
    }

    public function removeTraduction(Traduction $traduction): static
    {
        if ($this->traductions->removeElement($traduction)) {
            // set the owning side to null (unless already changed)
            if ($traduction->getLabelorig() === $this) {
                $traduction->setLabelorig(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Traduction>
     */
    public function getTraductionsId(): Collection
    {
        return $this->traductions_id;
    }

    public function addTraductionsId(Traduction $traductionsId): static
    {
        if (!$this->traductions_id->contains($traductionsId)) {
            $this->traductions_id->add($traductionsId);
            $traductionsId->setComposantId($this);
        }

        return $this;
    }

    public function removeTraductionsId(Traduction $traductionsId): static
    {
        if ($this->traductions_id->removeElement($traductionsId)) {
            // set the owning side to null (unless already changed)
            if ($traductionsId->getComposantId() === $this) {
                $traductionsId->setComposantId(null);
            }
        }

        return $this;
    }
}
