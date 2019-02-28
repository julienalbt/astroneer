<?php

namespace App\Controller;

use App\Entity\Ressources;
use App\Form\RessourcesType;
use App\Repository\RessourcesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ressources")
 */
class RessourcesController extends AbstractController {

    /**
     * @Route("/", name="ressources_index", methods={"GET"})
     */
    public function index(RessourcesRepository $ressourcesRepository): Response {
        return $this->render('ressources/index.html.twig', [
                    'ressources' => $ressourcesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ressources_new", methods={"GET","POST"})
     */
    public function newAction(Request $request): Response {
        $ressource = new Ressources();
        $ressource->setImageIndexName($ressource->getImageIndexName());
        $imgIndexOri = \basename($ressource->getImageIndexName());
        $ressource->setImageShowName($ressource->getImageShowName());
        $imgShowOri = \basename($ressource->getImageShowName());
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($ressource->getImageIndexName()) {
                $file = $ressource->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_ressource_directory'), $fileName);
                $ressource->setImageIndexName($fileName);
            } else {
                $ressource->setImageIndexName($imgIndexOri);
            }
            
            if ($ressource->getImageShowName()) {
                $file2 = $ressource->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_ressource_directory'), $fileName2);
                $ressource->setImageShowName($fileName2);
            } else {
                $ressource->setImageShowName($imgShowOri);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('ressources_index');
        }

        return $this->render('ressources/new.html.twig', [
                    'ressource' => $ressource,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ressources_show", methods={"GET"})
     */
    public function show(Ressources $ressource): Response {
        return $this->render('ressources/show.html.twig', [
                    'ressource' => $ressource,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ressources_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ressources $ressource): Response {
        $ressource->setImageIndexName($ressource->getImageIndexName());
        $imgIndexOri = \basename($ressource->getImageIndexName());
        $ressource->setImageShowName($ressource->getImageShowName());
        $imgShowOri = \basename($ressource->getImageShowName());
        
        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($ressource->getImageIndexName()) {
                $file = $ressource->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_ressource_directory'), $fileName);
                $ressource->setImageIndexName($fileName);
            } else {
                $ressource->setImageIndexName($imgIndexOri);
            }
            
            if ($ressource->getImageShowName()) {
                $file2 = $ressource->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_ressource_directory'), $fileName2);
                $ressource->setImageShowName($fileName2);
            } else {
                $ressource->setImageShowName($imgShowOri);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ressources_index', [
                        'id' => $ressource->getId(),
            ]);
        }

        return $this->render('ressources/edit.html.twig', [
                    'ressource' => $ressource,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ressources_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ressources $ressource): Response {
        if ($this->isCsrfTokenValid('delete' . $ressource->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ressources_index');
    }
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
