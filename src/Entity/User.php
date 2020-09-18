<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $last_name;

    /**
     * @ORM\Column(type="date")
     */
    private $birth_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone_number;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="patient_id")
     */
    private $consultations;

    /**
     * Date/Time of the last activity
     *
     * @var \Datetime
     * @ORM\Column(name="last_activity_at", type="datetime")
     */
    protected $last_activity_at;

    /**
     * @ORM\OneToMany(targetEntity=Consultation::class, mappedBy="doctor_id")
     */
    private $doctor_consultations;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->doctor_consultations = new ArrayCollection();
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(\DateTimeInterface $birth_date): self
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(int $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setPatientId($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getPatientId() === $this) {
                $consultation->setPatientId(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->first_name.' '.$this->last_name;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return \Datetime
     */
    public function getLastActivityAt()
    {
        return $this->last_activity_at;
    }

    /**
     * @param \Datetime $last_activity_at
     */
    public function setLastActivityAt($last_activity_at)
    {
        $this->last_activity_at = $last_activity_at;
    }

    /**
     * @return Bool Whether the user is active or not
     */
    public function isActiveNow()
    {
        // Delay during wich the user will be considered as still active
        $delay = new \DateTime('2 minutes ago');
        return ( $this->getLastActivityAt() > $delay );
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getDoctorConsultations(): Collection
    {
        return $this->doctor_consultations;
    }

    public function addDoctorConsultation(Consultation $doctorConsultation): self
    {
        if (!$this->doctor_consultations->contains($doctorConsultation)) {
            $this->doctor_consultations[] = $doctorConsultation;
            $doctorConsultation->setDoctorId($this);
        }

        return $this;
    }

    public function removeDoctorConsultation(Consultation $doctorConsultation): self
    {
        if ($this->doctor_consultations->contains($doctorConsultation)) {
            $this->doctor_consultations->removeElement($doctorConsultation);
            // set the owning side to null (unless already changed)
            if ($doctorConsultation->getDoctorId() === $this) {
                $doctorConsultation->setDoctorId(null);
            }
        }

        return $this;
    }

}
