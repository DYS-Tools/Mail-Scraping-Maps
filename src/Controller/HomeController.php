<?php

namespace App\Controller;

use App\Form\KeywordSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Export;
use App\Service\Fetching;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, Export $export, Fetching $fetching): Response
    {
        $form = $this->createForm(KeywordSearchType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request = $form->getData()['search'];

            $results = $fetching->fetch('https://www.google.fr/maps/search/' . $request . 'e/@49.6192493,0.257829,12z');
            //$results = "I's a Results";

            return $this->render('home/result.html.twig', [
            'results' => $results,
        ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
