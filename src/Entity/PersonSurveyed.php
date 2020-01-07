<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonSurveyedRepository")
 */
class PersonSurveyed
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
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reply", mappedBy="personSurveyed")
     */
    private $reply;

    public function __construct()
    {
        $this->reply = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Reply[]
     */
    public function getReply(): Collection
    {
        return $this->reply;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->reply->contains($reply)) {
            $this->reply[] = $reply;
            $reply->setPersonSurveyed($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->reply->contains($reply)) {
            $this->reply->removeElement($reply);
            // set the owning side to null (unless already changed)
            if ($reply->getPersonSurveyed() === $this) {
                $reply->setPersonSurveyed(null);
            }
        }

        return $this;
    }
}
