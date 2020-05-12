<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PlanRepository::class)
 * @ORM\Table(name="`plan`")
 */
class Plan
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\ManyToOne(targetEntity=Destination::class, inversedBy="plans")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="purchase_plans")
     */
    private $registred_users;

    /**
     * @ORM\OneToOne(targetEntity=Forum::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $forum;

    public function __construct()
    {
        $this->registred_users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRegistredUsers(): Collection
    {
        return $this->registred_users;
    }

    public function addRegistredUser(User $registredUser): self
    {
        if (!$this->registred_users->contains($registredUser)) {
            $this->registred_users[] = $registredUser;
        }

        return $this;
    }

    public function removeRegistredUser(User $registredUser): self
    {
        if ($this->registred_users->contains($registredUser)) {
            $this->registred_users->removeElement($registredUser);
        }

        return $this;
    }

    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    public function setForum(Forum $forum): self
    {
        $this->forum = $forum;

        return $this;
    }
}
