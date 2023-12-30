<?php

namespace App\Entity;

use App\Repository\IllustrationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IllustrationRepository::class)]
class Illustration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['data'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['data'])]
    private ?string $titre = null;

    #[ORM\Column(length: 100)]
    #[Groups(['data'])]
    private ?string $defaultlang = null;

    #[ORM\Column(length: 255)]
    #[Groups(['data'])]
    private ?string $imgsrc = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['data'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'illus_id', targetEntity: Composant::class)]
    private Collection $composants;

    public function __construct()
    {
        $this->composants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDefaultlang(): ?string
    {
        return $this->defaultlang;
    }

    public function setDefaultlang(string $defaultlang): static
    {
        $this->defaultlang = $defaultlang;

        return $this;
    }

    public function getImgsrc(): ?string
    {
        return $this->imgsrc;
    }

    public function setImgsrc(string $imgsrc): static
    {
        $this->imgsrc = $imgsrc;

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

    /**
     * @return Collection<int, Composant>
     */

    #[Groups(['data'])]
    public function getComposants(): Collection
    {
        return $this->composants;
    }

    public function addComposant(Composant $composant): static
    {
        if (!$this->composants->contains($composant)) {
            $this->composants->add($composant);
            $composant->setIllusId($this);
        }

        return $this;
    }

    public function removeComposant(Composant $composant): static
    {
        if ($this->composants->removeElement($composant)) {
            // set the owning side to null (unless already changed)
            if ($composant->getIllusId() === $this) {
                $composant->setIllusId(null);
            }
        }

        return $this;
    }
}
