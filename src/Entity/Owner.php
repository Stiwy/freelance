<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subscription;

    /**
     * @ORM\Column(type="datetime")
     */
    private $inscription_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $renewal_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expirate_date;

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

    public function getSubscription(): ?string
    {
        return $this->subscription;
    }

    public function setSubscription(string $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getInscriptionDate(): ?\DateTimeInterface
    {
        return $this->inscription_date;
    }

    public function setInscriptionDate(\DateTimeInterface $inscription_date): self
    {
        $this->inscription_date = $inscription_date;

        return $this;
    }

    public function getRenewalDate(): ?\DateTimeInterface
    {
        return $this->renewal_date;
    }

    public function setRenewalDate(?\DateTimeInterface $renewal_date): self
    {
        $this->renewal_date = $renewal_date;

        return $this;
    }

    public function getExpirateDate(): ?\DateTimeInterface
    {
        return $this->expirate_date;
    }

    public function setExpirateDate(\DateTimeInterface $expirate_date): self
    {
        $this->expirate_date = $expirate_date;

        return $this;
    }
}
