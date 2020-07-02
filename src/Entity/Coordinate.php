<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoordinateRepository")
 */
class Coordinate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Le nom est trop long, il ne doit pas dépasser {{ limit }} caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse' est obligatoire")
     */
    private $adress;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Le code postale est obligatoire")
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="La ville est obligatoire")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="Le téléphone est obligatoire")
     * @Assert\Length(
     *      max = 15,
     *      maxMessage = "Le numéro de téléphone est trop long, il ne doit pas dépasser {{ limit }} caractères")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\NotBlank(message="Le mail est obligatoire")
     * @Assert\Email(message="Format d'adresse mail invalide")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timetableOpen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timetableClose;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $longitude;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timetableOpenWeekend;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timetableCloseWeekend;

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

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
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

    public function getTimetableOpen(): ?\DateTimeInterface
    {
        return $this->timetableOpen;
    }

    public function setTimetableOpen(\DateTimeInterface $timetableOpen): self
    {
        $this->timetableOpen = $timetableOpen;

        return $this;
    }

    public function getTimetableClose(): ?\DateTimeInterface
    {
        return $this->timetableClose;
    }

    public function setTimetableClose(\DateTimeInterface $timetableClose): self
    {
        $this->timetableClose = $timetableClose;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getTimetableOpenWeekend(): ?\DateTimeInterface
    {
        return $this->timetableOpenWeekend;
    }

    public function setTimetableOpenWeekend(\DateTimeInterface $timetableOpenWeekend): self
    {
        $this->timetableOpenWeekend = $timetableOpenWeekend;

        return $this;
    }

    public function getTimetableCloseWeekend(): ?\DateTimeInterface
    {
        return $this->timetableCloseWeekend;
    }

    public function setTimetableCloseWeekend(\DateTimeInterface $timetableCloseWeekend): self
    {
        $this->timetableCloseWeekend = $timetableCloseWeekend;

        return $this;
    }
}
