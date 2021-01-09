<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FooterRepository")
 */
class Footer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="L'adresse est obligatoire")
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "L'adresse est trop longue, elle ne doit pas dépasser {{ limit }} caractères")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Le numéro de téléphone est obligatoire")
     * @Assert\Length(
     *      max = 20,
     *      maxMessage = "Le numéro de téléphone est trop long, il ne doit pas dépasser {{ limit }} caractères")
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
