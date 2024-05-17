<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: PriceRepository::class)]
#[ApiResource]
class Price
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['wash_station:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['wash_station:read'])]
    private ?float $value = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $rate = 0;

    #[ORM\ManyToOne(inversedBy: 'prices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WashStation $washStation = null;

    #[ORM\ManyToOne(inversedBy: 'prices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $modelUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getWashStation(): ?WashStation
    {
        return $this->washStation;
    }

    public function setWashStation(?WashStation $washStation): static
    {
        $this->washStation = $washStation;

        return $this;
    }

    public function getModelUser(): ?User
    {
        return $this->modelUser;
    }

    public function setModelUser(?User $modelUser): static
    {
        $this->modelUser = $modelUser;

        return $this;
    }
}
