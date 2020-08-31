<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $doctor_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="binary")
     */
    private $asked;

    /**
     * @ORM\Column(type="binary")
     */
    private $confirmed;

    /**
     * @ORM\Column(type="integer")
     */
    private $canceled;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoctorId(): ?int
    {
        return $this->doctor_id;
    }

    public function setDoctorId(int $doctor_id): self
    {
        $this->doctor_id = $doctor_id;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAsked()
    {
        return $this->asked;
    }

    public function setAsked($asked): self
    {
        $this->asked = $asked;

        return $this;
    }

    public function getConfirmed()
    {
        return $this->confirmed;
    }

    public function setConfirmed($confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    public function getCanceled(): ?int
    {
        return $this->canceled;
    }

    public function setCanceled(int $canceled): self
    {
        $this->canceled = $canceled;

        return $this;
    }

    public function getPatientId(): ?User
    {
        return $this->patient_id;
    }

    public function setPatientId(?User $patient_id): self
    {
        $this->patient_id = $patient_id;

        return $this;
    }
}
