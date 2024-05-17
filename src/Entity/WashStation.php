<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WashStationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WashStationRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['wash_station:read']])]
class WashStation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['wash_station:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['wash_station:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['wash_station:read'])]
    private ?string $address = null;

    #[ORM\Column]
    #[Groups(['wash_station:read'])]
    private ?float $longitude = null;

    #[ORM\Column]
    #[Groups(['wash_station:read'])]
    private ?float $latitude = null;

    /**
     * @var Collection<int, Price>
     */
    #[ORM\OneToMany(targetEntity: Price::class, mappedBy: 'washStation', orphanRemoval: true)]
    #[Groups(['wash_station:read'])]
    private Collection $prices;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return Collection<int, Price>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): static
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->setWashStation($this);
        }

        return $this;
    }

    public function removePrice(Price $price): static
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getWashStation() === $this) {
                $price->setWashStation(null);
            }
        }

        return $this;
    }
}
