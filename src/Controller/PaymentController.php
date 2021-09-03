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

class PaymentController extends AbstractController
{
    /**
     * @Route("/pay/", name="app_pay")
     */
    public function indexListPrice(): Response
    {

        return $this->render('home/payment.html.twig', [
        ]);
    }
}
