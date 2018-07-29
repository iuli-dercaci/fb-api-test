<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank()
     * @Assert\Type(type="array", message="The Strips value must be an array.")
     * @var string
     */
    private $strips;

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
    public function getStrips()
    {
        return $this->strips;
    }

    /**
     * @param array $strips
     * @return Team
     */
    public function setStrips(array $strips): self
    {
        $this->strips = $strips;

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
