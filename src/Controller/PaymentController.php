<?php

namespace App\Controller;

use App\Form\CreditType;
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
    public function indexListPrice(Request $request, PhpParser $phpParser): Response
    {

        $form = $this->createForm(CreditType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $credit = $form->getData()['credit']; 

            $coeff = 0 ; 

            if ( $credit < 1000 ) {
                $price = $credit * 0.17 ; 
            }

            if ( $credit > 2000 ) {
                $price = $credit * 0.15 ; 
            }

            if ( $credit > 4000 ) {
                $price = $credit * 0.14 ; 
            }

            if ( $credit > 10000 ) {
                $price = $credit * 0.10 ; 
            }
            
            return $this->render('payment/pay.html.twig', [
            'credit' => $credit,
            'price' => $price,
        ]);
        }


        return $this->render('home/payment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
