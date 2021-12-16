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
}
