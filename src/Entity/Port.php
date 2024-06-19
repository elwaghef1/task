<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource]
class Port
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['port:read', 'public:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['port:read', 'port:write', 'public:read'])]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['port:read', 'port:write'])]
    private string $address;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['port:read', 'port:write'])]
    private ?string $addressComplement = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: "/^\d{5}$/", message: 'Invalid postal code')]
    #[Groups(['port:read', 'port:write', 'public:read'])]
    private string $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['port:read', 'port:write', 'public:read'])]
    private string $city;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Groups(['port:read', 'port:write', 'public:read'])]
    private string $country;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\Email]
    #[Groups(['port:read', 'port:write'])]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Assert\Regex(pattern: "/^\+?[0-9\s\-]*$/", message: 'Invalid phone number')]
    #[Groups(['port:read', 'port:write'])]
    private ?string $phone = null;

    private const LATITUDE = 46.4968;
    private const LONGITUDE = -1.7836;

    #[Groups(['port:read', 'public:read'])]
    public function getCoords(): Coords
    {
        return new Coords(self::LATITUDE, self::LONGITUDE);
    }

    // Getters and setters

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

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressComplement(): ?string
    {
        return $this->addressComplement;
    }

    public function setAddressComplement(?string $addressComplement): self
    {
        $this->addressComplement = $addressComplement;

        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
