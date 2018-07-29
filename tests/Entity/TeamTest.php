<?php

namespace App\Tests\Entity;


use App\Entity\League;
use App\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class LeagueTest extends TestCase
{
    /**
     * @var League
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new League();
    }

    public function testGetterAndSetter() {

        $name = 'A';
        $team = new Team();

        $this->assertNull($this->object->getId());

        $this->object->setName($name);
        $this->assertEquals($name, $this->object->getName());

        $this->object->addTeam($team);
        $this->assertInstanceOf(ArrayCollection::class, $this->object->getTeams());
        $this->assertEquals(1, count($this->object->getTeams()));
        $this->assertInstanceOf(Team::class, $this->object->getTeams()->first());
    }
}