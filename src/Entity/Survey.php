<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SurveyRepository")
 */
class Survey
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="surveys")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reply", mappedBy="survey", cascade={"persist", "remove"})
     */
    private $reply;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FieldSurvey", mappedBy="survey", orphanRemoval=true)
     */
    private $fieldSurveys;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $hashIdentifier;


    public function __construct($user)
    {
        $this->created_at = new \DateTime();
        $this->fieldSurveys = new ArrayCollection();
        $this->user= $user;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getResponse(): ?Reply
    {
        return $this->response;
    }

    public function setResponse(Reply $reply): self
    {
        $this->response = $reply;

        // set the owning side of the relation if necessary
        if ($reply->getSurvey() !== $this) {
            $reply->setSurvey($this);
        }

        return $this;
    }

    /**
     * @return Collection|FieldSurvey[]
     */
    public function getFieldSurveys(): Collection
    {
        return $this->fieldSurveys;
    }

    public function addFieldSurvey(FieldSurvey $fieldSurvey): self
    {
        if (!$this->fieldSurveys->contains($fieldSurvey)) {
            $this->fieldSurveys[] = $fieldSurvey;
            $fieldSurvey->setSurvey($this);
        }

        return $this;
    }

    public function removeFieldSurvey(FieldSurvey $fieldSurvey): self
    {
        if ($this->fieldSurveys->contains($fieldSurvey)) {
            $this->fieldSurveys->removeElement($fieldSurvey);
            // set the owning side to null (unless already changed)
            if ($fieldSurvey->getSurvey() === $this) {
                $fieldSurvey->setSurvey(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->name;
    }

    public function getHashIdentifier(): ?string
    {
        return $this->hashIdentifier;
    }

    public function setHashIdentifier(string $hashIdentifier): self
    {
        $this->hashIdentifier = $hashIdentifier;

        return $this;
    }
}
