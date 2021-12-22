<?php

namespace App\Entity;

use App\Repository\MissionStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionStatusRepository::class)
 */
class MissionStatus
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
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $insert_date;

    /**
     * @ORM\OneToMany(targetEntity=Mission::class, mappedBy="missionStatus")
     */
    private $mission;

    /**
     * @ORM\ManyToOne(targetEntity=Owner::class, inversedBy="missionStatuses")
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $background_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $font_color;

    /**
     * @ORM\Column(type="integer")
     */
    private $priority;

    public function __construct()
    {
        $this->mission = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getStatus();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection|Mission[]
     */
    public function getMission(): Collection
    {
        return $this->mission;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->mission->contains($mission)) {
            $this->mission[] = $mission;
            $mission->setMissionStatus($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->mission->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getMissionStatus() === $this) {
                $mission->setMissionStatus(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->background_color;
    }

    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }

    public function getFontColor(): ?string
    {
        return $this->font_color;
    }

    public function setFontColor(string $font_color): self
    {
        $this->font_color = $font_color;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
