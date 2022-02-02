<?php

namespace App\Controller;

use App\Service\CallApiService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DepartmentController extends AbstractController
{
    /**
     * @Route("/department/{department}", name="departement")
     */
    public function index(string $department, CallApiService $callApiService, ChartBuilderInterface $chartBuilder): Response
    {
        $label = [];
        $hospitalisation = [];
        $rea = [];

        for ($i=1; $i < 8; $i++) { 
             $date = New DateTime('- '. $i .' day');
             $datas = $callApiService->getAllDataByDate($date->format('d-m-Y'));

             foreach ($datas as $data) {
                 if( $data['lib_dep'] === $department) {
                     $label[] = $data['date'];
                     $hospitalisation[] = $data['hosp'];
                     $rea[] = $data['rea'];
                     break;
                 }
             }
         }
         
        //dd($label);
        //dd($hospitalisation);
        //dd($rea);
        
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
             'labels' => array_reverse($label),
             'datasets' => [
                 [
                     'label' => 'Nouvelles Hospitalisations',
                     'borderColor' => 'rgb(255, 99, 132)',
                     'data' => array_reverse($hospitalisation),
                 ],
                 [
                     'label' => 'Nouvelles entrées en Réa',
                     'borderColor' => 'rgb(46, 41, 78)',
                     'data' => array_reverse($rea),
                 ],
             ],
         ]);

         $chart->setOptions([/* ... */]);

        //dd($callApiService->getDepartmentData());
        return $this->render('departement/index.html.twig', [
            'data' => $callApiService->getAllData($department),
            'chart' => $chart,
        ]);
    }
}
