<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $pseudoPlayer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstNamePlayer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastNamePlayer;

    /**
     * @ORM\Column(type="date")
     */
    private $datePlayer;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionPlayer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rolePlayer;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="player")
     */
    private $game;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagePlayer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudoPlayer(): ?string
    {
        return $this->pseudoPlayer;
    }

    public function setPseudoPlayer(string $pseudoPlayer): self
    {
        $this->pseudoPlayer = $pseudoPlayer;

        return $this;
    }

    public function getFirstNamePlayer(): ?string
    {
        return $this->firstNamePlayer;
    }

    public function setFirstNamePlayer(string $firstNamePlayer): self
    {
        $this->firstNamePlayer = $firstNamePlayer;

        return $this;
    }

    public function getLastNamePlayer(): ?string
    {
        return $this->lastNamePlayer;
    }

    public function setLastNamePlayer(string $lastNamePlayer): self
    {
        $this->lastNamePlayer = $lastNamePlayer;

        return $this;
    }

    public function getDatePlayer(): ?\DateTimeInterface
    {
        return $this->datePlayer;
    }

    public function setDatePlayer(\DateTimeInterface $datePlayer): self
    {
        $this->datePlayer = $datePlayer;

        return $this;
    }

    public function getDescriptionPlayer(): ?string
    {
        return $this->descriptionPlayer;
    }

    public function setDescriptionPlayer(string $descriptionPlayer): self
    {
        $this->descriptionPlayer = $descriptionPlayer;

        return $this;
    }

    public function getRolePlayer(): ?string
    {
        return $this->rolePlayer;
    }

    public function setRolePlayer(string $rolePlayer): self
    {
        $this->rolePlayer = $rolePlayer;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function getImagePlayer(): ?string
    {
        return $this->imagePlayer;
    }

    public function setImagePlayer(string $imagePlayer): self
    {
        $this->imagePlayer = $imagePlayer;

        return $this;
    }
}
