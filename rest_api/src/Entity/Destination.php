<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DestinationRepository::class)
 */
class Destination
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phrase;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation;

    /**
     * @ORM\Column(type="integer")
     */
    private $activity_level;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_group;

    /**
     * @ORM\Column(type="integer")
     */
    private $min_group;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $region;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(?string $phrase): self
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getActivityLevel(): ?int
    {
        return $this->activity_level;
    }

    public function setActivityLevel(int $activity_level): self
    {
        $this->activity_level = $activity_level;

        return $this;
    }

    public function getMaxGroup(): ?int
    {
        return $this->max_group;
    }

    public function setMaxGroup(int $max_group): self
    {
        $this->max_group = $max_group;

        return $this;
    }

    public function getMinGroup(): ?int
    {
        return $this->min_group;
    }

    public function setMinGroup(int $min_group): self
    {
        $this->min_group = $min_group;

        return $this;
    }

    public function getCountry(): ?int
    {
        return $this->country;
    }

    public function setCountry(int $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }
}
