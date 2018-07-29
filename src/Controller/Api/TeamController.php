<?php

namespace App\Controller\Api;


use App\Controller\BeforeActionSubscriber;
use App\Entity\League;
use App\Entity\Team;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/team")
 */
class TeamController extends BeforeActionSubscriber
{
    /**
     * @Route("", name="create_team", methods={"POST"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function create(Request $request, ValidatorInterface $validator)
    {
        $name = $request->get('name');
        $strips = $request->get('strips');
        $leagueId = $request->get('league_id');
        $response = new JsonResponse();

        /** @var League $league */
        $league = $this->getDoctrine()->getRepository(League::class)->find($leagueId);

        $team = new Team();
        $team->setName($name);
        $team->setStrips($strips);
        $team->setLeague($league);

        $errors = $validator->validate($team);

        if (!count($errors)) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();
            $response->setStatusCode(Response::HTTP_CREATED);

        } else {

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setData($errors->get(0)->getMessage());
        }

        return $response;
    }

    /**
     * @Route("/{id}", name="update_team", methods={"PUT"}, requirements={"id"="\d+"})
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param Team|null $team
     * @return Response
     */
    public function update(Request $request, ValidatorInterface $validator, Team $team = null): Response
    {
        if (!$team) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        /** @var League $league */
        $name = $request->get('name');
        $strips = $request->get('strips');
        $leagueId = $request->get('league_id');
        $league = $this->getDoctrine()->getRepository(League::class)->find($leagueId);

        $team->setName($name);
        $team->setStrips($strips);
        $team->setLeague($league);

        $errors = $validator->validate($team);

        $response = new JsonResponse();

        if (!count($errors)) {

            $em = $this->getDoctrine()->getManager();
            $em->merge($team);
            $em->flush();
            $response->setStatusCode(Response::HTTP_OK);

        } else {

            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setData($errors->get(0)->getMessage());
        }

        return $response;
    }
}
