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
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function Home(): Response
    {

        return $this->render('home.html.twig', [
          
        ]);
    }


    /**
     * @Route("/getMail", name="scrapping_mail")
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

            $client = HttpClient::create();
            $response = $client->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');

            // DEMO
            $statusCode = $response->getStatusCode(); // $statusCode = 200
            $contentType = $response->getHeaders()['content-type'][0]; // // $contentType = 'application/json'
            $content = $response->getContent(); // $content = '{"id":521583, "name":"symfony-docs", ...}'
            $content = $response->toArray(); // // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

            $test = $statusCode; 

            return $this->render('service/Scrapping/result.html.twig', [
            'results' => json_encode($results),
            'test' => $test,
        ]);
        }

        return $this->render('service/Scrapping/scrappingMail.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sell", name="landing_page_1")
     */
    public function landingPage(): Response
    {

        return $this->render('landingPage.html.twig', [
          
        ]);
    }
}
