<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="owner", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Customer::class, mappedBy="owner", orphanRemoval=true)
     */
    private $customers;

    /**
     * @ORM\OneToMany(targetEntity=MissionStatus::class, mappedBy="owner")
     */
    private $missionStatuses;

    /**
     * @ORM\ManyToMany(targetEntity=Tva::class, mappedBy="owner")
     */
    private $tvas;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->missionStatuses = new ArrayCollection();
        $this->tvas = new ArrayCollection();
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setOwner(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getOwner() !== $this) {
            $user->setOwner($this);
        }

        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->setOwner($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getOwner() === $this) {
                $customer->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MissionStatus[]
     */
    public function getMissionStatuses(): Collection
    {
        return $this->missionStatuses;
    }

    public function addMissionStatus(MissionStatus $missionStatus): self
    {
        if (!$this->missionStatuses->contains($missionStatus)) {
            $this->missionStatuses[] = $missionStatus;
            $missionStatus->setOwner($this);
        }

        return $this;
    }

    public function removeMissionStatus(MissionStatus $missionStatus): self
    {
        if ($this->missionStatuses->removeElement($missionStatus)) {
            // set the owning side to null (unless already changed)
            if ($missionStatus->getOwner() === $this) {
                $missionStatus->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tva[]
     */
    public function getTvas(): Collection
    {
        return $this->tvas;
    }

    public function addTva(Tva $tva): self
    {
        if (!$this->tvas->contains($tva)) {
            $this->tvas[] = $tva;
            $tva->addOwner($this);
        }

        return $this;
    }

    public function removeTva(Tva $tva): self
    {
        if ($this->tvas->removeElement($tva)) {
            $tva->removeOwner($this);
        }

        return $this;
    }
}
