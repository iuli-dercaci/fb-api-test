<?php

namespace App\Repository;

use App\Entity\League;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @method League|null find($id, $lockMode = null, $lockVersion = null)
 * @method League|null findOneBy(array $criteria, array $orderBy = null)
 * @method League[]    findAll()
 * @method League[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeagueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, League::class);
    }

    /**
     * @param League $league
     * @return array
     */
    public function getLeagueTeamsSerialized(League $league): array
    {
        $serializer = new Serializer(array(new ObjectNormalizer()));

        $data = $serializer->normalize($league, null, ['attributes' => ['id','name']]);

        $data['teams'] = $serializer->normalize(
            $league->getTeams(), null, ['attributes' => ['id','name','strips']]
        );

        return $data;
    }
}
