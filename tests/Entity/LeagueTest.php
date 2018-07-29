<?php

namespace App\Tests\Entity;


use App\Entity\Team;
use App\Entity\League;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /**
     * @var Team
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Team();
    }

    public function testGetterAndSetter() {

        $name = 'Fast bees';
        $strips = ['yellow', 'black'];
        $league = new League();

        $this->assertNull($this->object->getId());

        $this->object->setName($name);
        $this->assertEquals($name, $this->object->getName());

        $this->object->setStrips($strips);
        $this->assertEquals($strips, $this->object->getStrips());

        $this->object->setLeague($league);
        $this->assertInstanceOf(League::class, $this->object->getLeague());
    }
}