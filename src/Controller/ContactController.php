<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact', name: 'contact_')]
class ContactController extends AbstractController
{
    #[
        Route('/new', name: 'new', methods: ['POST'])
    ]
    public function index(Request $request): JsonResponse
    {
        dd($request);
        return new JsonResponse(['message' => 'ok'], Response::HTTP_OK);
    }

}
