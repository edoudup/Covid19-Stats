<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/departement", name="departement")
     */
    public function browse(CallApiService $callApiService): Response
    {
        //dd($callApiService->getDepartmentData());
        return $this->render('departement/browse.html.twig', [
            'data' => $callApiService->getFranceData(),
            'departments' => $callApiService->getAllData(),
        ]);
    }

    /**
     * @Route("/departement/{department}", name="departement-detail")
     */
    public function read(string $department, CallApiService $callApiService): Response
    {
        //dd($callApiService->getDepartmentData());
        return $this->render('departement/read.html.twig', [
            'data' => $callApiService->getAllData($department),
        ]);
    }
}
