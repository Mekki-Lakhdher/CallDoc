<?php

namespace App\Entity;

use App\Repository\DoctorSpecialistTitleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorSpecialistTitleRepository::class)
 */
class DoctorSpecialistTitle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=DoctorSpeciality::class, inversedBy="doctor_specialist_titles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $speciality_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialist_title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialityId(): ?DoctorSpeciality
    {
        return $this->speciality_id;
    }

    public function setSpecialityId(?DoctorSpeciality $speciality_id): self
    {
        $this->speciality_id = $speciality_id;

        return $this;
    }

    public function getSpecialistTitle(): ?string
    {
        return $this->specialist_title;
    }

    public function setSpecialistTitle(string $specialist_title): self
    {
        $this->specialist_title = $specialist_title;

        return $this;
    }
}
