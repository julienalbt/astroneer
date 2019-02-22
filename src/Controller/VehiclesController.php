<?php

namespace App\Controller;

use App\Entity\Vehicles;
use App\Form\VehiclesType;
use App\Repository\VehiclesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicles")
 */
class VehiclesController extends AbstractController
{
    /**
     * @Route("/", name="vehicles_index", methods={"GET"})
     */
    public function index(VehiclesRepository $vehiclesRepository): Response
    {
        return $this->render('vehicles/index.html.twig', [
            'vehicles' => $vehiclesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vehicles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vehicle = new Vehicles();
        $form = $this->createForm(VehiclesType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('vehicles_index');
        }

        return $this->render('vehicles/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicles_show", methods={"GET"})
     */
    public function show(Vehicles $vehicle): Response
    {
        return $this->render('vehicles/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vehicles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vehicles $vehicle): Response
    {
        $form = $this->createForm(VehiclesType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vehicles_index', [
                'id' => $vehicle->getId(),
            ]);
        }

        return $this->render('vehicles/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vehicles $vehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicles_index');
    }
}
