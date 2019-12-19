<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResponseRepository")
 */
class Response
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={ "default" : false })
     */
    private $is_completed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserFront", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_front;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Survey", inversedBy="response", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;
    

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getIsCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setIsCompleted(bool $is_completed): self
    {
        $this->is_completed = $is_completed;

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

    public function getUserFront(): ?UserFront
    {
        return $this->user_front;
    }

    public function setUserFront(UserFront $user_front): self
    {
        $this->user_front = $user_front;

        return $this;
    }

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }


}
