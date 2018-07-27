<?php
/**
 * @author iuli dercaci
 * 27/07/18 11:08
 */

namespace App\DataFixtures;


use App\Entity\League;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TeamFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    private $strips;

    /**
     * @var array
     */
    private $names;


    public function __construct()
    {
        $this->strips = ['red', 'yellow', 'blue', 'green', 'white', 'black'];
        // taken from http://www.goal.com/en-gb/news/the-top-30-funniest-fantasy-football-team-names/mxwfmgsm71bd14859aqzxx27h
        $this->names  = [
            'lallanas in pyjamas',
            'who ate all depays?',
            'ctrl alt de laet',
            'game of throw-ins',
            'show me da mané',
            'benteke fried chicken',
            'flying without ings',
            'the wizard of ozil',
            'ayew ready?',
            'guns \'n moses',
            'lord of the ings',
            'no weimann no cry',
            'klopps and robbers',
            'neville wears prada',
            'boom xhakalaka',
            'balotellitubbies',
            'cesc and the city',
            'absolutely fabregas',
            'dirty sanchez',
            'men behaving chadli',
            'egg fried reus',
            'riders of yohan',
            'blink-1eto\'o',
            'baines on toast',
            'pique blinders',
            'bacuna matata',
            'the zarate kid',
            'murder on zidane\'s floor',
            'kroos control',
            'gylfi pleasures',
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->names as $name) {

            $team = new Team();
            $team->setName(ucwords($name))
                ->setStripes($this->getStripes())
                ->setLeague($this->getLeague());

            $manager->persist($team);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            LeagueFixtures::class,
        ];
    }

    /**
     * get random strips
     * @return array
     */
    private function getStripes(): array
    {
        $keys = array_rand($this->strips, 2);
        
        return [
            $this->strips[$keys[0]],
            $this->strips[$keys[1]],
        ];
    }

    /**
     * @return League
     */
    private function getLeague(): League
    {
        $key = array_rand(LeagueFixtures::LEAGUE_NAMES);
        $name = sprintf('%s_league', LeagueFixtures::LEAGUE_NAMES[$key]);

        return $this->getReference($name);
    }
}