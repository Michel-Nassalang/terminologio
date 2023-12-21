<?php

namespace App\Entity;

use App\Repository\TraductionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraductionRepository::class)]
class Traduction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'traductions')]
    private ?composant $labelorig = null;

    #[ORM\Column(length: 100)]
    private ?string $labeltrad = null;

    #[ORM\ManyToOne(inversedBy: 'traductions_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?composant $composant_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptiontrad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelorig(): ?composant
    {
        return $this->labelorig;
    }

    public function setLabelorig(?composant $labelorig): static
    {
        $this->labelorig = $labelorig;

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

    public function getComposantId(): ?composant
    {
        return $this->composant_id;
    }

    public function setComposantId(?composant $composant_id): static
    {
        $this->composant_id = $composant_id;

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
}
