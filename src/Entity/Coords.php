<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

class Coords
{
    #[Groups(['port:read'])]
    private ?float $latitude;

    #[Groups(['port:read'])]
    private ?float $longitude;

    public function __construct(?float $latitude, ?float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
}
