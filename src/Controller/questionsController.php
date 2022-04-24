<?php

namespace App\Controller;
use App\Services\questionsServices;
use App\Validations\questionsValidations;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class questionsController extends AbstractController
{

    /**
     * @Rest\Post(path="api/question")
     */
    public function questionAction(Request $request)
    {
        $questionsServices = new questionsServices();
        $questionsValidations = new questionsValidations();
        $response = new JsonResponse();
        $allQuestions = [];

        $parameters = json_decode($request->getContent(), true);
        $checkParameters = $questionsValidations->checkParameters($parameters);

        if(!$checkParameters['validate']){         
            $response->setData(
                [
                    'status' => 'Failure',
                    'error' => $checkParameters['errors']
                ]
            );
           $response->setStatusCode(400);
        }
        else {
            $allQuestions = $questionsServices->getData(
                $checkParameters['data']['Fromdate'],
                $checkParameters['data']['Todate'],
                $checkParameters['data']['Tagged']
            );
            $response->setData(
                [
                    'status' => 'Success',
                    'count'   => count($allQuestions['items']),
                    'items'   => $allQuestions['items']
                ]
            );
        }
        return $response;
    }
}
