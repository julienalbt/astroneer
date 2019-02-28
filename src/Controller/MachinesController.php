<?php

namespace App\Controller;

use App\Entity\Machines;
use App\Form\MachinesType;
use App\Repository\MachinesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/machines")
 */
class MachinesController extends AbstractController
{
    /**
     * @Route("/", name="machines_index", methods={"GET"})
     */
    public function index(MachinesRepository $machinesRepository): Response
    {
        return $this->render('machines/index.html.twig', [
            'machines' => $machinesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="machines_new", methods={"GET","POST"})
     */
    public function newAction(Request $request): Response
    {
        $machine = new Machines();
        $machine->setImageIndexName($machine->getImageIndexName());
        $imgIndexOri = \basename($machine->getImageIndexName());
        $machine->setImageShowName($machine->getImageShowName());
        $imgShowOri = \basename($machine->getImageShowName());
        $form = $this->createForm(MachinesType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($machine->getImageIndexName()) {
                $file = $machine->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_machine_directory'), $fileName);
                $machine->setImageIndexName($fileName);
            } else {
                $machine->setImageIndexName($imgIndexOri);
            }
            
            if ($machine->getImageShowName()) {
                $file2 = $machine->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_machine_directory'), $fileName2);
                $machine->setImageShowName($fileName2);
            } else {
                $machine->setImageShowName($imgShowOri);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($machine);
            $entityManager->flush();

            return $this->redirectToRoute('machines_index');
        }

        return $this->render('machines/new.html.twig', [
            'machine' => $machine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machines_show", methods={"GET"})
     */
    public function show(Machines $machine): Response
    {
        return $this->render('machines/show.html.twig', [
            'machine' => $machine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="machines_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Machines $machine): Response
    {
        $machine->setImageIndexName($machine->getImageIndexName());
        $imgIndexOri = \basename($machine->getImageIndexName());
        $machine->setImageShowName($machine->getImageShowName());
        $imgShowOri = \basename($machine->getImageShowName());
        $form = $this->createForm(MachinesType::class, $machine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($machine->getImageIndexName()) {
                $file = $machine->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_machine_directory'), $fileName);
                $machine->setImageIndexName($fileName);
            } else {
                $machine->setImageIndexName($imgIndexOri);
            }
            
            if ($machine->getImageShowName()) {
                $file2 = $machine->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_machine_directory'), $fileName2);
                $machine->setImageShowName($fileName2);
            } else {
                $machine->setImageShowName($imgShowOri);
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('machines_index', [
                'id' => $machine->getId(),
            ]);
        }

        return $this->render('machines/edit.html.twig', [
            'machine' => $machine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="machines_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Machines $machine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$machine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($machine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('machines_index');
    }
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}