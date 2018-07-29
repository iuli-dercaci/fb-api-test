<?php

namespace App\Controller\Api;


use App\Entity\League;
use App\Repository\LeagueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/league", name="league", )
 */
class LeagueController extends Controller
{
    /**
     * @var LeagueRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;


    /**
     * LeagueController constructor.
     * @param EntityManagerInterface $entityManager
     * @param LeagueRepository $repository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LeagueRepository $repository
    ){
        $this->em = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @Route("/{id}", name="league", methods={"GET"}, requirements={"id"="\d+"})
     * @param League $league
     * @return Response
     */
    public function leagueTeams(League $league = null): Response
    {
        if (!$league) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }

        $data = $this->repository->getLeagueTeamsSerialized($league);

        return new JsonResponse($data);
    }

    /**
     * @Route("/{id}")
     * @param League $league
     * @return Response
     */
    public function delete(League $league = null): Response
    {
        if (!$league) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }

        $this->em->remove($league);
        $this->em->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
