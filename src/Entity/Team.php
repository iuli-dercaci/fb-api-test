<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="json")
     * @var string
     */
    private $stripes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     * @var League
     */
    private $league;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getStripes()
    {
        return $this->stripes;
    }

    /**
     * @param $stripes
     * @return Team
     */
    public function setStripes($stripes): self
    {
        $this->stripes = $stripes;

        return $this;
    }

    /**
     * @return League|null
     */
    public function getLeague(): ?League
    {
        return $this->league;
    }

    /**
     * @param League|null $league
     * @return Team
     */
    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }
}
