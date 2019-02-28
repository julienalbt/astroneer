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
 * @Route("")
 */
class PlanetsController extends AbstractController
{
    /**
     * @Route("/planets/", name="planets_index", methods={"GET"})
     */
    public function index(PlanetsRepository $planetsRepository): Response
    {
        return $this->render('planets/index.html.twig', [
            'planets' => $planetsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/planets/new", name="planets_new", methods={"GET","POST"})
     */
    public function newAction(Request $request): Response
    {
        $planet = new Planets();
        $planet->setImageIndexName($planet->getImageIndexName());
        $imgIndexOri = \basename($planet->getImageIndexName());
        $planet->setImageShowName($planet->getImageShowName());
        $imgShowOri = \basename($planet->getImageShowName());
        $form = $this->createForm(PlanetsType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($planet->getImageIndexName()) {
                $file = $planet->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_planet_directory'), $fileName);
                $planet->setImageIndexName($fileName);
            } else {
                $planet->setImageIndexName($imgIndexOri);
            }
            
            if ($planet->getImageShowName()) {
                $file2 = $planet->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_planet_directory'), $fileName2);
                $planet->setImageShowName($fileName2);
            } else {
                $planet->setImageShowName($imgShowOri);
            }
            
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
     * @Route("/planets/{id}", name="planets_show", methods={"GET"})
     */
    public function show(Planets $planet): Response
    {
        return $this->render('planets/show.html.twig', [
            'planet' => $planet,
        ]);
    }

    /**
     * @Route("/admin/planets/{id}/edit", name="planets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Planets $planet): Response
    {
        $planet->setImageIndexName($planet->getImageIndexName());
        $imgIndexOri = \basename($planet->getImageIndexName());
        $planet->setImageShowName($planet->getImageShowName());
        $imgShowOri = \basename($planet->getImageShowName());
        $form = $this->createForm(PlanetsType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($planet->getImageIndexName()) {
                $file = $planet->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_planet_directory'), $fileName);
                $planet->setImageIndexName($fileName);
            } else {
                $planet->setImageIndexName($imgIndexOri);
            }
            
            if ($planet->getImageShowName()) {
                $file2 = $planet->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_planet_directory'), $fileName2);
                $planet->setImageShowName($fileName2);
            } else {
                $planet->setImageShowName($imgShowOri);
            }
            
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
     * @Route("/admin/planets/{id}", name="planets_delete", methods={"DELETE"})
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
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
