<?php

namespace App\Entity;

use App\Repository\TraductionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TraductionRepository::class)]
class Traduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['trad'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'traductions')]
    #[Groups(['trad'])]
    private ?Composant $composant = null;

    #[ORM\Column(length: 100)]
    #[Groups(['trad'])]
    private ?string $labeltrad = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['trad'])]
    private ?string $descriptiontrad = null;

    #[ORM\Column(length: 50)]
    #[Groups(['trad'])]
    private ?string $lang = null;

    #[ORM\ManyToOne(inversedBy: 'traductions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['trad'])]
    private ?Illustration $illustration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComposant(): ?Composant
    {
        return $this->composant;
    }

    public function setComposant(?Composant $composant): static
    {
        $this->composant = $composant;
        return $this;
    }

    public function getLabeltrad(): ?string
    {
        return $this->labeltrad;
    }

    public function setLabeltrad(string $labeltrad): static
    {
        $this->labeltrad = $labeltrad;

        return $this;
    }

    public function getDescriptiontrad(): ?string
    {
        return $this->descriptiontrad;
    }

    public function setDescriptiontrad(?string $descriptiontrad): static
    {
        $this->descriptiontrad = $descriptiontrad;

        return $this;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    public function getIllustration(): ?Illustration
    {
        return $this->illustration;
    }

    public function setIllustration(?Illustration $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }
}
