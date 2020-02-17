<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    private $id;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     * @Assert\Length(
     *     max = 100,
     *     maxMessage = "Votre prénom {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     * @Assert\Length(
     *     max = 100,
     *     maxMessage = "Votre nom {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     */
    private $lastname;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Veuillez renseigner ce champ")
     * @Assert\Length(
     *     max = 255,
     *     maxMessage = "Votre email {{ value }} ne peut pas faire plus de {{ limit }} caractères"
     * )
     * @Assert\Email(message="Veuillez indiquer une adresse de courriel valide")
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     */
    private $subject;

    /**
     * @Assert\NotBlank(message="Veuillez remplir ce champ")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
