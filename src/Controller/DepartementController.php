<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartementController extends AbstractController
{
    /**
     * @Route("/departement/{department}", name="departement")
     */
    public function index(string $department, CallApiService $callApiService): Response
    {
        //dd($callApiService->getDepartmentData());
        return $this->render('departement/index.html.twig', [
            'data' => $callApiService->getDepartmentData($department),
        ]);
    }
}
