<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ForumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ForumRepository::class)
 */
class Forum
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Destination::class, inversedBy="forum", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\OneToMany(targetEntity=ForumComment::class, mappedBy="forum", orphanRemoval=true)
     */
    private $forum_messages;

    /**
     * @ORM\Column(type="date")
     */
    private $create_date;

    public function __construct()
    {
        $this->forum_messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return Collection|ForumComment[]
     */
    public function getForumMessages(): Collection
    {
        return $this->forum_messages;
    }

    public function addForumMessage(ForumComment $forumMessage): self
    {
        if (!$this->forum_messages->contains($forumMessage)) {
            $this->forum_messages[] = $forumMessage;
            $forumMessage->setForum($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumComment $forumMessage): self
    {
        if ($this->forum_messages->contains($forumMessage)) {
            $this->forum_messages->removeElement($forumMessage);
            // set the owning side to null (unless already changed)
            if ($forumMessage->getForum() === $this) {
                $forumMessage->setForum(null);
            }
        }

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->create_date;
    }

    public function setCreateDate(\DateTimeInterface $create_date): self
    {
        $this->create_date = $create_date;

        return $this;
    }
}
