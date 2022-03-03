<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchType::class, data: null);
        $form->handleRequest($request);

        if($form->isSubmitted && $form->isValid)
        {
            $data = $form->getData();
        }

        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
