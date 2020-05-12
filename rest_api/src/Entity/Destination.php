<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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

    /**
     * @ORM\OneToOne(targetEntity=Forum::class, mappedBy="destination", cascade={"persist", "remove"})
     */
    private $forum;

    /**
     * @ORM\OneToMany(targetEntity=DestinationComment::class, mappedBy="destination", orphanRemoval=true)
     */
    private $users_comments;

    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="destination", orphanRemoval=true)
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="destination", orphanRemoval=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="destination", orphanRemoval=true)
     */
    private $plans;

    /**
     * @ORM\ManyToMany(targetEntity=WishList::class, mappedBy="destinations")
     */
    private $wishLists;


    public function __construct()
    {
        $this->users_comments = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->plans = new ArrayCollection();
        $this->wishlist_users = new ArrayCollection();
        $this->wishLists = new ArrayCollection();
    }

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

    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    public function setForum(Forum $forum): self
    {
        $this->forum = $forum;

        // set the owning side of the relation if necessary
        if ($forum->getDestination() !== $this) {
            $forum->setDestination($this);
        }

        return $this;
    }

    /**
     * @return Collection|DestinationComment[]
     */
    public function getUsersComments(): Collection
    {
        return $this->users_comments;
    }

    public function addUsersComment(DestinationComment $usersComment): self
    {
        if (!$this->users_comments->contains($usersComment)) {
            $this->users_comments[] = $usersComment;
            $usersComment->setDestination($this);
        }

        return $this;
    }

    public function removeUsersComment(DestinationComment $usersComment): self
    {
        if ($this->users_comments->contains($usersComment)) {
            $this->users_comments->removeElement($usersComment);
            // set the owning side to null (unless already changed)
            if ($usersComment->getDestination() === $this) {
                $usersComment->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setDestination($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getDestination() === $this) {
                $medium->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setDestination($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getDestination() === $this) {
                $note->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setDestination($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->contains($plan)) {
            $this->plans->removeElement($plan);
            // set the owning side to null (unless already changed)
            if ($plan->getDestination() === $this) {
                $plan->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WishList[]
     */
    public function getWishLists(): Collection
    {
        return $this->wishLists;
    }

    public function addWishList(WishList $wishList): self
    {
        if (!$this->wishLists->contains($wishList)) {
            $this->wishLists[] = $wishList;
            $wishList->addDestination($this);
        }

        return $this;
    }

    public function removeWishList(WishList $wishList): self
    {
        if ($this->wishLists->contains($wishList)) {
            $this->wishLists->removeElement($wishList);
            $wishList->removeDestination($this);
        }

        return $this;
    }

}
