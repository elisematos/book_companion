<?php

namespace App\Entity;

use App\Repository\ProgressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressRepository::class)]
class Progress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $bookId;

    #[ORM\Column(type: 'integer')]
    private $pagesRead;

    #[ORM\OneToMany(mappedBy: 'progress', targetEntity: Note::class, orphanRemoval: true)]
    private $notes;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'progress')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): ?string
    {
        return $this->bookId;
    }

    public function setBookId(string $bookId): self
    {
        $this->bookId = $bookId;

        return $this;
    }

    public function getPagesRead(): ?int
    {
        return $this->pagesRead;
    }

    public function setPagesRead(int $pagesRead): self
    {
        $this->pagesRead = $pagesRead;

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
            $note->setProgress($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getProgress() === $this) {
                $note->setProgress(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
