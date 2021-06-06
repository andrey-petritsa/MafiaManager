<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClubRepository::class)
 */
class Club
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=GameSession::class, mappedBy="club")
     */
    private $gameSessions;

    /**
     * @ORM\OneToMany(targetEntity=ClubMembership::class, mappedBy="club")
     */
    private $clubMemberships;

    public function __construct()
    {
        $this->gameSessions = new ArrayCollection();
        $this->clubMemberships = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getOrganisator(): ?Player
    {
        return $this->organisator;
    }

    public function setOrganisator(Player $organisator): self
    {
        $this->organisator = $organisator;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|GameSession[]
     */
    public function getGameSessions(): Collection
    {
        return $this->gameSessions;
    }

    public function addGameSession(GameSession $gameSession): self
    {
        if (!$this->gameSessions->contains($gameSession)) {
            $this->gameSessions[] = $gameSession;
            $gameSession->setClub($this);
        }

        return $this;
    }

    public function removeGameSession(GameSession $gameSession): self
    {
        if ($this->gameSessions->removeElement($gameSession)) {
            // set the owning side to null (unless already changed)
            if ($gameSession->getClub() === $this) {
                $gameSession->setClub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClubMembership[]
     */
    public function getClubMemberships(): Collection
    {
        return $this->clubMemberships;
    }

    public function addClubMembership(ClubMembership $clubMembership): self
    {
        if (!$this->clubMemberships->contains($clubMembership)) {
            $this->clubMemberships[] = $clubMembership;
            $clubMembership->setClub($this);
        }

        return $this;
    }

    public function removeClubMembership(ClubMembership $clubMembership): self
    {
        if ($this->clubMemberships->removeElement($clubMembership)) {
            // set the owning side to null (unless already changed)
            if ($clubMembership->getClub() === $this) {
                $clubMembership->setClub(null);
            }
        }

        return $this;
    }
}
