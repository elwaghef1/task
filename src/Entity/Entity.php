<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\DecisionEnum;
use App\Enum\SegmentEnum;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
#[Vich\Uploadable]
class Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['admin:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['admin:read'])]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, enumType: SegmentEnum::class)]
    #[Groups(['admin:read'])]
    private SegmentEnum $segment;

    #[ORM\Column(type: 'string', length: 255, enumType: DecisionEnum::class)]
    #[Groups(['admin:read'])]
    private DecisionEnum $decision;

    #[ORM\Column(type: 'float')]
    #[Groups(['admin:read'])]
    private float $priceVariation;

    #[ORM\Column(type: 'integer')]
    #[Groups(['admin:read'])]
    private int $reference;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['admin:read'])]
    private ?string $alias = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['entity:read', 'public:read', 'admin:read'])]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'entity', targetEntity: Manufacturer::class)]
    #[Groups(['admin:read'])]
    private Collection $manufacturers;

    public function __construct()
    {
        $this->manufacturers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSegment(): SegmentEnum
    {
        return $this->segment;
    }

    public function setSegment(SegmentEnum $segment): self
    {
        $this->segment = $segment;
        return $this;
    }

    public function getDecision(): DecisionEnum
    {
        return $this->decision;
    }

    public function setDecision(DecisionEnum $decision): self
    {
        $this->decision = $decision;
        return $this;
    }

    public function getPriceVariation(): float
    {
        return $this->priceVariation;
    }

    public function setPriceVariation(float $priceVariation): self
    {
        $this->priceVariation = $priceVariation;
        return $this;
    }

    public function getReference(): int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;
        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getManufacturers(): Collection
    {
        return $this->manufacturers;
    }

    public function addManufacturer(Manufacturer $manufacturer): self
    {
        if (!$this->manufacturers->contains($manufacturer)) {
            $this->manufacturers[] = $manufacturer;
            $manufacturer->setEntity($this);
        }

        return $this;
    }

    public function removeManufacturer(Manufacturer $manufacturer): self
    {
        if ($this->manufacturers->removeElement($manufacturer)) {
            if ($manufacturer->getEntity() === $this) {
                $manufacturer->setEntity(null);
            }
        }

        return $this;
    }
}
