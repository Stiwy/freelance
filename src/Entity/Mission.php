<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $details;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insert_date;

    /**
     * @ORM\ManyToOne(targetEntity=MissionStatus::class, inversedBy="mission")
     * @ORM\JoinColumn(nullable=false)
     */
    private $missionStatus;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="missions")
     */
    private $customer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $work_duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $invoice_recurency;

    /**
     * @ORM\Column(type="float")
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rate_reccurency;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $invoice_last_dade;

    /**
     * @ORM\Column(type="datetime")
     */
    private $invoice_deadline_date;

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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getInsertDate(): ?\DateTimeInterface
    {
        return $this->insert_date;
    }

    public function setInsertDate(\DateTimeInterface $insert_date): self
    {
        $this->insert_date = $insert_date;

        return $this;
    }

    public function getMissionStatus(): ?MissionStatus
    {
        return $this->missionStatus;
    }

    public function setMissionStatus(?MissionStatus $missionStatus): self
    {
        $this->missionStatus = $missionStatus;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getWorkDuration(): ?int
    {
        return $this->work_duration;
    }

    public function setWorkDuration(?int $work_duration): self
    {
        $this->work_duration = $work_duration;

        return $this;
    }

    public function getInvoiceRecurency(): ?string
    {
        return $this->invoice_recurency;
    }

    public function setInvoiceRecurency(string $invoice_recurency): self
    {
        $this->invoice_recurency = $invoice_recurency;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getRateReccurency(): ?string
    {
        return $this->rate_reccurency;
    }

    public function setRateReccurency(string $rate_reccurency): self
    {
        $this->rate_reccurency = $rate_reccurency;

        return $this;
    }

    public function getInvoiceLastDade(): ?\DateTimeInterface
    {
        return $this->invoice_last_dade;
    }

    public function setInvoiceLastDade(?\DateTimeInterface $invoice_last_dade): self
    {
        $this->invoice_last_dade = $invoice_last_dade;

        return $this;
    }

    public function getInvoiceDeadlineDate(): ?\DateTimeInterface
    {
        return $this->invoice_deadline_date;
    }

    public function setInvoiceDeadlineDate(\DateTimeInterface $invoice_deadline_date): self
    {
        $this->invoice_deadline_date = $invoice_deadline_date;

        return $this;
    }
}
