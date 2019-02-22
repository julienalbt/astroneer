<?php

namespace App\Controller;

use App\Entity\Planets;
use App\Form\PlanetsType;
use App\Repository\PlanetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planets")
 */
class PlanetsController extends AbstractController
{
    /**
     * @Route("/", name="planets_index", methods={"GET"})
     */
    public function index(PlanetsRepository $planetsRepository): Response
    {
        return $this->render('planets/index.html.twig', [
            'planets' => $planetsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planet = new Planets();
        $form = $this->createForm(PlanetsType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planet);
            $entityManager->flush();

            return $this->redirectToRoute('planets_index');
        }

        return $this->render('planets/new.html.twig', [
            'planet' => $planet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planets_show", methods={"GET"})
     */
    public function show(Planets $planet): Response
    {
        return $this->render('planets/show.html.twig', [
            'planet' => $planet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Planets $planet): Response
    {
        $form = $this->createForm(PlanetsType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planets_index', [
                'id' => $planet->getId(),
            ]);
        }

        return $this->render('planets/edit.html.twig', [
            'planet' => $planet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planets_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Planets $planet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planets_index');
    }
}
