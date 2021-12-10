<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BolsaController extends AbstractController
{
    private $bolsa = [
        "result" =>[  
            [
                "bid" => 117.25,
                "currency" => "USD",
                "displayName" => "Apple"
            ],
            [
                "bid" => 211.25,
                "currency" => "USD",
                "displayName" => "Microsoft"
            ]
        ]
    ];

    /**
     * @Route("/bolsa", methods="GET")
     */
    public function getBolsa(): Response
    {
        return new Response(json_encode($this->bolsa), 200, ["Access-Control-Allow-Origin" => "*"]);
    }
    /**
     * @Route("/compra")
     */
    public function compraAcao(): Response
    {
        if(file_exists("compras.json")){
            $this->compra = json_decode(file_get_contents("compras.json"));
            array_push(
                $this->compra, 
                [
                    "bid" => 117.25,
                    "currency" => "USD",
                    "displayName" => "Apple"
                ],
                [
                    "bid" => 211.25,
                    "currency" => "USD",
                    "displayName" => "Microsoft"
                ]
            );
            file_put_contents("compras.json", $this->compra);
            return new Response(true, 200, ["Access-Control-Allow-Origin" => "*"]);
        }
        array_push(
            $this->compra, 
            [
                "bid" => 117.25,
                "currency" => "USD",
                "displayName" => "Apple"
            ],
            [
                "bid" => 211.25,
                "currency" => "USD",
                "displayName" => "Microsoft"
            ]
        );
        file_put_contents("compras.json", $this->compra);
        return new Response(true, 200, ["Access-Control-Allow-Origin" => "*"]);
    }
    /**
     * @Route("/carteira")
     */
    public function mostraCarteira(): Response
    {
        if(file_exists("compras.json")){
            $this->compra = json_decode(file_get_contents("compras.json"));
            return new Response(json_encode($this->compra));
        }
        return new Response("Carteira vazia!", 200, ["Access-Control-Allow-Origin" => "*"]);
    } 
}