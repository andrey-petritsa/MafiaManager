<?php

namespace App\Entity;

use App\Repository\PlayerResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerResultRepository::class)
 */
class PlayerResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_win;

    /**
     * @ORM\Column(type="float")
     */
    private $bonus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(String $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getIsWin(): ?bool
    {
        return $this->is_win;
    }

    public function setIsWin(bool $is_win): self
    {
        $this->is_win = $is_win;

        return $this;
    }

    public function getBonus(): ?float
    {
        return $this->bonus;
    }

    public function setBonus(float $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }
}
