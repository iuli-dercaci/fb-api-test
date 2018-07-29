<?php

namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private $object;


    protected function setUp()
    {
        $this->object = new User();
    }

    /**
     * @dataProvider userDataProvider
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function testGetterAndSetter($username, $email, $password)
    {
        $this->object->setUsername($username)
            ->setEmail($email)
            ->setPassword($password);

        $this->assertNull($this->object->getId());
        $this->assertEquals($username, $this->object->getUsername());
        $this->assertEquals($email, $this->object->getEmail());
        $this->assertTrue($this->object->getIsActive());
        $this->assertEquals($password, $this->object->getPassword());
    }

    /**
     * @dataProvider userDataProvider
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function testUserCanBeSerialized($username, $email, $password)
    {
        $this->object->setUsername($username)
            ->setEmail($email)
            ->setPassword($password);

        $serialized = serialize([null, $username, $password]);
        $this->assertEquals($serialized, $this->object->serialize());
    }

    /**
     * @dataProvider userDataProvider
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function testUserCanBeUnserialized($username, $email, $password)
    {
        $serialized = serialize([null, $username, $password]);
        $this->object->unserialize($serialized);
        $this->assertNull($this->object->getId());
        $this->assertEquals($username, $this->object->getUsername());
        $this->assertEquals($password, $this->object->getPassword());
    }

    /**
     * @return array
     */
    public function userDataProvider()
    {
        return [
            ['john.doe', 'john.doe@mail.com', 'test']
        ];
    }
}