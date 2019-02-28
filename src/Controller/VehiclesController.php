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
 * @Route("")
 */
class VehiclesController extends AbstractController
{
    /**
     * @Route("/vehicles/", name="vehicles_index", methods={"GET"})
     */
    public function index(VehiclesRepository $vehiclesRepository): Response
    {
        return $this->render('vehicles/index.html.twig', [
            'vehicles' => $vehiclesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/vehicles/new", name="vehicles_new", methods={"GET","POST"})
     */
    public function newAction(Request $request): Response
    {
        $vehicle = new Vehicles();
        $vehicle->setImageIndexName($vehicle->getImageIndexName());
        $imgIndexOri = \basename($vehicle->getImageIndexName());
        $vehicle->setImageShowName($vehicle->getImageShowName());
        $imgShowOri = \basename($vehicle->getImageShowName());
        $form = $this->createForm(VehiclesType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($vehicle->getImageIndexName()) {
                $file = $vehicle->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_vehicle_directory'), $fileName);
                $vehicle->setImageIndexName($fileName);
            } else {
                $vehicle->setImageIndexName($imgIndexOri);
            }
            
            if ($vehicle->getImageShowName()) {
                $file2 = $vehicle->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_vehicle_directory'), $fileName2);
                $vehicle->setImageShowName($fileName2);
            } else {
                $vehicle->setImageShowName($imgShowOri);
            }
            
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
     * @Route("/vehicles/{id}", name="vehicles_show", methods={"GET"})
     */
    public function show(Vehicles $vehicle): Response
    {
        return $this->render('vehicles/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @Route("/admin/vehicles/{id}/edit", name="vehicles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vehicles $vehicle): Response
    {
        $vehicle->setImageIndexName($vehicle->getImageIndexName());
        $imgIndexOri = \basename($vehicle->getImageIndexName());
        $vehicle->setImageShowName($vehicle->getImageShowName());
        $imgShowOri = \basename($vehicle->getImageShowName());
        $form = $this->createForm(VehiclesType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if ($vehicle->getImageIndexName()) {
                $file = $vehicle->getImageIndexName();
                $fileName = $this->generateUniqueFileName() . '.jpg';
                $file->move($this->getParameter('upload_index_vehicle_directory'), $fileName);
                $vehicle->setImageIndexName($fileName);
            } else {
                $vehicle->setImageIndexName($imgIndexOri);
            }
            
            if ($vehicle->getImageShowName()) {
                $file2 = $vehicle->getImageShowName();
                $fileName2 = $this->generateUniqueFileName() . '.jpg';
                $file2->move($this->getParameter('upload_show_vehicle_directory'), $fileName2);
                $vehicle->setImageShowName($fileName2);
            } else {
                $vehicle->setImageShowName($imgShowOri);
            }
            
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
     * @Route("/admin/vehicles/{id}", name="vehicles_delete", methods={"DELETE"})
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
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}