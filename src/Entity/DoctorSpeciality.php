<?php

namespace App\Entity;

use App\Repository\DoctorSpecialityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DoctorSpecialityRepository::class)
 */
class DoctorSpeciality
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $speciality;

    /**
     * @ORM\OneToMany(targetEntity=DoctorSpecialistTitle::class, mappedBy="speciality_id")
     */
    private $doctor_specialist_titles;

    public function __construct()
    {
        $this->doctor_specialist_titles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return Collection|DoctorSpecialistTitle[]
     */
    public function getDoctorSpecialistTitles(): Collection
    {
        return $this->doctor_specialist_titles;
    }

    public function addDoctorSpecialistTitle(DoctorSpecialistTitle $doctorSpecialistTitle): self
    {
        if (!$this->doctor_specialist_titles->contains($doctorSpecialistTitle)) {
            $this->doctor_specialist_titles[] = $doctorSpecialistTitle;
            $doctorSpecialistTitle->setSpecialityId($this);
        }

        return $this;
    }

    public function removeDoctorSpecialistTitle(DoctorSpecialistTitle $doctorSpecialistTitle): self
    {
        if ($this->doctor_specialist_titles->contains($doctorSpecialistTitle)) {
            $this->doctor_specialist_titles->removeElement($doctorSpecialistTitle);
            // set the owning side to null (unless already changed)
            if ($doctorSpecialistTitle->getSpecialityId() === $this) {
                $doctorSpecialistTitle->setSpecialityId(null);
            }
        }

        return $this;
    }
}
