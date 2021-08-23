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
            $results = [];
            //trying scrap with googleMaps
            $url = 'https://www.google.fr/maps/search/'.$request.'/@49.1481275,1.5162138,9z';
            //$url = $fetching->fetch('https://www.google.fr/maps/search/' . $request . '/');

            // Scraping logic example
            //$url = 'https://www.google.fr';
            $html = $phpParser->file_get_html($url); // GET url
            //dd($html);
            $links = $html->find("a");  // find first a balise
            foreach ($links as $el) {
                array_push($results, $el->href);
            }

            return $this->render('home/result.html.twig', [
            'results' => json_encode($results),
        ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
