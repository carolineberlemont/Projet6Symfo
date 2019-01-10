<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

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
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
     */
    private $birthYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $birthMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $birthDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $kind;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="text")
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

    public function getKind(): ?bool
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
