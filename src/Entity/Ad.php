<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
USE Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *  fields={"title"}, 
 *  message="Une autre annonce possède deja ce titre, merci de le modifier")
 */
class Ad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255, maxMessage="le titre ne doit pas faire plus de 255 caractères")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     * @Assert\Length(min=4, max=4, exactMessage="L'année doit être sous la forme YYYY")
     */
    private $birthYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\LessThan(value=13, message="Le mois doit être compris en 1 et 12")
     * @Assert\GreaterThan(value=0, message="Le mois doit être compris en 1 et 12")
     */
    private $birthMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\LessThan(value=32, message="Le jour doit être compris en 1 et 31")
     * @Assert\GreaterThan(value=0, message="Le jour doit être compris en 1 et 31")
     */
    private $birthDay;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $kind;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $country;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champ est obligatoire")
     */
    private $content;

    /**
     * Permet de generer un slug adapter à chaque nouvelle annonce
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initializeSlug() {
        if(empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug =$slugify->slugify($this->title);

        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBirthYear()
    {
        return $this->birthYear;
    }

    public function setBirthYear($birthYear): self
    {
        $this->birthYear = $birthYear;

        return $this;
    }

    public function getBirthMonth()
    {
        return $this->birthMonth;
    }

    public function setBirthMonth($birthMonth): self
    {
        $this->birthMonth = $birthMonth;

        return $this;
    }

    public function getBirthDay()
    {
        return $this->birthDay;
    }

    public function setBirthDay($birthDay): self
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(?bool $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
