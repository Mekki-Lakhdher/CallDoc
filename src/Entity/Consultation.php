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
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $asked_by_patient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $asked_by_patient_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $confirmed_by_doctor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $confirmed_by_doctor_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $canceled_by_doctor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $canceled_by_doctor_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $canceled_by_patient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $canceled_by_patient_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patient_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="doctor_consultations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $doctor_id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAskedByPatient()
    {
        return $this->asked_by_patient;
    }

    /**
     * @param mixed $asked_by_patient
     */
    public function setAskedByPatient($asked_by_patient): void
    {
        $this->asked_by_patient = $asked_by_patient;
    }

    /**
     * @return mixed
     */
    public function getAskedByPatientAt()
    {
        return $this->asked_by_patient_at;
    }

    /**
     * @param mixed $asked_by_patient_at
     */
    public function setAskedByPatientAt($asked_by_patient_at): void
    {
        $this->asked_by_patient_at = $asked_by_patient_at;
    }

    /**
     * @return mixed
     */
    public function getConfirmedByDoctor()
    {
        return $this->confirmed_by_doctor;
    }

    /**
     * @param mixed $confirmed_by_doctor
     */
    public function setConfirmedByDoctor($confirmed_by_doctor): void
    {
        $this->confirmed_by_doctor = $confirmed_by_doctor;
    }

    /**
     * @return mixed
     */
    public function getConfirmedByDoctorAt()
    {
        return $this->confirmed_by_doctor_at;
    }

    /**
     * @param mixed $confirmed_by_doctor_at
     */
    public function setConfirmedByDoctorAt($confirmed_by_doctor_at): void
    {
        $this->confirmed_by_doctor_at = $confirmed_by_doctor_at;
    }

    /**
     * @return mixed
     */
    public function getCanceledByDoctor()
    {
        return $this->canceled_by_doctor;
    }

    /**
     * @param mixed $canceled_by_doctor
     */
    public function setCanceledByDoctor($canceled_by_doctor): void
    {
        $this->canceled_by_doctor = $canceled_by_doctor;
    }

    /**
     * @return mixed
     */
    public function getCanceledByDoctorAt()
    {
        return $this->canceled_by_doctor_at;
    }

    /**
     * @return mixed
     */
    public function getCanceledByPatient()
    {
        return $this->canceled_by_patient;
    }

    /**
     * @param mixed $canceled_by_patient
     */
    public function setCanceledByPatient($canceled_by_patient): void
    {
        $this->canceled_by_patient = $canceled_by_patient;
    }

    /**
     * @return mixed
     */
    public function getCanceledByPatientAt()
    {
        return $this->canceled_by_patient_at;
    }

    /**
     * @param mixed $canceled_by_patient_at
     */
    public function setCanceledByPatientAt($canceled_by_patient_at): void
    {
        $this->canceled_by_patient_at = $canceled_by_patient_at;
    }

    /**
     * @param mixed $canceled_by_doctor_at
     */
    public function setCanceledByDoctorAt($canceled_by_doctor_at): void
    {
        $this->canceled_by_doctor_at = $canceled_by_doctor_at;
    }

    /**
     * @return mixed
     */
    public function getConfirmedByPatient()
    {
        return $this->confirmed_by_patient;
    }

    /**
     * @param mixed $confirmed_by_patient
     */
    public function setConfirmedByPatient($confirmed_by_patient): void
    {
        $this->confirmed_by_patient = $confirmed_by_patient;
    }

    /**
     * @return mixed
     */
    public function getConfirmedByPatientAt()
    {
        return $this->confirmed_by_patient_at;
    }

    /**
     * @param mixed $confirmed_by_patient_at
     */
    public function setConfirmedByPatientAt($confirmed_by_patient_at): void
    {
        $this->confirmed_by_patient_at = $confirmed_by_patient_at;
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

    public function getPatientId(): ?User
    {
        return $this->patient_id;
    }

    public function setPatientId(?User $patient_id): self
    {
        $this->patient_id = $patient_id;

        return $this;
    }

    public function getDoctorId(): ?User
    {
        return $this->doctor_id;
    }

    public function setDoctorId(?User $doctor_id): self
    {
        $this->doctor_id = $doctor_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
