<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Component;
use Symfony\Component\Intl\Locale\Locale;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @Assert\NotBlank(message="Merci de donner un titre à votre annonce")
     * @Assert\Length(max=255, maxMessage="le titre ne doit pas faire plus de 255 caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
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
     * @Assert\NotBlank
     */
    private $kind;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $country;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Le contenu doit être renseigné")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * Permet de generer un slug adapté à chaque nouvelle annonce
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

    public function setKind(?string $kind): self
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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }
}
