<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController {

    /**
     * @Route("", name="default")
     */
    public function indexAction() {
        return $this->render('default/index.html.twig', [
                    'controller_name' => 'DefaultController',
        ]);
    }

}
