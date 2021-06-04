<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=GameSession::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game_session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameSession(): ?GameSession
    {
        return $this->game_session;
    }

    public function setGameSession(?GameSession $game_session): self
    {
        $this->game_session = $game_session;

        return $this;
    }
}
