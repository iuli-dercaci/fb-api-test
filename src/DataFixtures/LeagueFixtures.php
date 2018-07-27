<?php
/**
 * @author iuli dercaci
 * 27/07/18 10:55
 */

namespace App\DataFixtures;


use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LeagueFixtures extends Fixture
{
    /**
     * @var array
     */
    public const LEAGUE_NAMES = ['A', 'B', 'C'];


    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::LEAGUE_NAMES as $name) {

            $league = new League();
            $league->setName($name);
            $manager->persist($league);

            $this->addReference(sprintf('%s_league', $name), $league);
        }

        $manager->flush();
    }
}
