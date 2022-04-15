<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CurrencyConverter;
use App\Form\Type\CurrencyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use  App\Service\ExchangeCurrency;



class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request, ExchangeCurrency $exchangeCurreny): Response
    {
        $converter = new CurrencyConverter();
        $result = [];
        $form = $this->createForm(CurrencyFormType::class, $converter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $result['exchangeFromCurrency'] =  $form->get('from')->getData();
          $result['exchangeToCurrency'] =$form->get('to')->getData();
          $result['amountToExchange'] = $form->get('amount')->getData();
          $result['exchangedAmount'] = $exchangeCurreny->getExchangeValue($result['amountToExchange'], $result['exchangeFromCurrency'] , $result['exchangeToCurrency']);  
        }

        return $this->renderForm('converter/index.html.twig', [
            'form' => $form,
            'result' => $result
        ]);
    }
}