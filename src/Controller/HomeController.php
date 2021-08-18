<?php

namespace App\Controller;

use App\Form\KeywordSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Export;
use App\Service\Fetching;
use App\Service\PhpParser;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, Export $export, Fetching $fetching, PhpParser $phpParser): Response
    {
        $form = $this->createForm(KeywordSearchType::class);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request = $form->getData()['search']; 

            //trying scrap with googleMaps
            $url = $fetching->fetch('https://www.google.fr/maps/search/' . $request . '/');

            

            // Scraping logic example
            $url = 'https://www.google.fr';
            $html = $phpParser->file_get_html($url); // GET url
            $results = $html->find('a',0)->href;  // find first a balise

            return $this->render('home/result.html.twig', [
            'results' => $results,
        ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
