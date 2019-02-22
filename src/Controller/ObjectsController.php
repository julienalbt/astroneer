<?php

namespace App\Controller;

use App\Entity\Objects;
use App\Form\ObjectsType;
use App\Repository\ObjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objects")
 */
class ObjectsController extends AbstractController
{
    /**
     * @Route("/", name="objects_index", methods={"GET"})
     */
    public function index(ObjectsRepository $objectsRepository): Response
    {
        return $this->render('objects/index.html.twig', [
            'objects' => $objectsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="objects_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $object = new Objects();
        $form = $this->createForm(ObjectsType::class, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($object);
            $entityManager->flush();

            return $this->redirectToRoute('objects_index');
        }

        return $this->render('objects/new.html.twig', [
            'object' => $object,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objects_show", methods={"GET"})
     */
    public function show(Objects $object): Response
    {
        return $this->render('objects/show.html.twig', [
            'object' => $object,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objects_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objects $object): Response
    {
        $form = $this->createForm(ObjectsType::class, $object);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objects_index', [
                'id' => $object->getId(),
            ]);
        }

        return $this->render('objects/edit.html.twig', [
            'object' => $object,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objects_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objects $object): Response
    {
        if ($this->isCsrfTokenValid('delete'.$object->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($object);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objects_index');
    }
}
