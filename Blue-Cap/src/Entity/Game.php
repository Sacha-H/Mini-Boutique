<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255)
     */
    private $nameGame;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageGame;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="game")
     */
    private $player;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameGame(): ?string
    {
        return $this->nameGame;
    }

    public function setNameGame(string $nameGame): self
    {
        $this->nameGame = $nameGame;

        return $this;
    }

    public function getImageGame(): ?string
    {
        return $this->imageGame;
    }

    public function setImageGame(string $imageGame): self
    {
        $this->imageGame = $imageGame;

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player[] = $player;
            $player->setGame($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getGame() === $this) {
                $player->setGame(null);
            }
        }

        return $this;
    }
}
