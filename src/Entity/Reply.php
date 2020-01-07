<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply
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
     * @ORM\OneToOne(targetEntity="App\Entity\Survey", inversedBy="response", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $survey;

    /**
     * @ORM\Column(type="json")
     */
    private $mapping_question_response = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonSurveyed", inversedBy="reply")
     */
    private $personSurveyed;
    

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

    public function getSurvey(): ?Survey
    {
        return $this->survey;
    }

    public function setSurvey(Survey $survey): self
    {
        $this->survey = $survey;

        return $this;
    }

    public function getMappingQuestionResponse(): ?array
    {
        return $this->mapping_question_response;
    }

    public function setMappingQuestionResponse(array $mapping_question_response): self
    {
        $this->mapping_question_response = $mapping_question_response;

        return $this;
    }

    public function getPersonSurveyed(): ?PersonSurveyed
    {
        return $this->personSurveyed;
    }

    public function setPersonSurveyed(?PersonSurveyed $personSurveyed): self
    {
        $this->personSurveyed = $personSurveyed;

        return $this;
    }


}
