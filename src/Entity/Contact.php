<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{
    /**
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @Assert\Email(message="Veuillez renseigner un email valide")
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $country;

    /**
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $message;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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
