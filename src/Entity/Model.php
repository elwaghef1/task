<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\MaterialEnum;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)] // Assurez-vous que 'nullable: true' est défini
    #[Groups(['model:read', 'model:write'])]
    private ?string $type = null;

    #[ORM\Column(type: 'string', enumType: MaterialEnum::class)]
    private MaterialEnum $material;

    #[ORM\Column(type: 'float')]
    private float $length;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(type: 'boolean')]
    private bool $publish;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class)]
    #[ORM\JoinColumn(nullable: true)]
    private ?Manufacturer $manufacturer = null;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getMaterial(): MaterialEnum
    {
        return $this->material;
    }

    public function setMaterial(MaterialEnum $material): self
    {
        $this->material = $material;
        return $this;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function isPublish(): bool
    {
        return $this->publish;
    }

    public function setPublish(bool $publish): self
    {
        $this->publish = $publish;
        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
