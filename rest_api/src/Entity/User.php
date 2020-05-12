<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
     protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\GeneratedValue
     */
    private $create_date;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=DestinationComment::class, mappedBy="user", orphanRemoval=true)
     */
    private $destination_comments;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="user", orphanRemoval=true)
     */
    private $notes;

    /**
     * @ORM\ManyToMany(targetEntity=Plan::class, mappedBy="registred_users")
     */
    private $purchase_plans;

    /**
     * @ORM\OneToOne(targetEntity=WishList::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $wishList;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->destination_comments = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->purchase_plans = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreate_date(): DateTime
    {
        return $this->collator_create;
    }

    public function setCreate_date(DateTime $create_date): self
    {
        $this->collator_create = $create_date;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DestinationComment[]
     */
    public function getDestinationComments(): Collection
    {
        return $this->destination_comments;
    }

    public function addDestinationComment(DestinationComment $destinationComment): self
    {
        if (!$this->destination_comments->contains($destinationComment)) {
            $this->destination_comments[] = $destinationComment;
            $destinationComment->setUser($this);
        }

        return $this;
    }

    public function removeDestinationComment(DestinationComment $destinationComment): self
    {
        if ($this->destination_comments->contains($destinationComment)) {
            $this->destination_comments->removeElement($destinationComment);
            // set the owning side to null (unless already changed)
            if ($destinationComment->getUser() === $this) {
                $destinationComment->setUser(null);
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
            $note->setUser($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getUser() === $this) {
                $note->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPurchasePlans(): Collection
    {
        return $this->purchase_plans;
    }

    public function addPurchasePlan(Plan $purchasePlan): self
    {
        if (!$this->purchase_plans->contains($purchasePlan)) {
            $this->purchase_plans[] = $purchasePlan;
            $purchasePlan->addRegistredUser($this);
        }

        return $this;
    }

    public function removePurchasePlan(Plan $purchasePlan): self
    {
        if ($this->purchase_plans->contains($purchasePlan)) {
            $this->purchase_plans->removeElement($purchasePlan);
            $purchasePlan->removeRegistredUser($this);
        }

        return $this;
    }

    public function getWishList(): ?WishList
    {
        return $this->wishList;
    }

    public function setWishList(WishList $wishList): self
    {
        $this->wishList = $wishList;

        // set the owning side of the relation if necessary
        if ($wishList->getUser() !== $this) {
            $wishList->setUser($this);
        }

        return $this;
    }
}
