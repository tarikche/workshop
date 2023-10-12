<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class RequestController extends AbstractController
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    #[Route('/request', name: 'app_request')]
    public function index(request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $headers = [
            'Authorization' => 'Bearer ' . $_ENV['OPENAI_API_KEY'], // Add a space after 'Bearer'
            'Content-Type' => 'application/json',
        ];
        $response = $this->client->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => $headers,
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $data['message'],
                    ],
                ],
            ],
        ]);
        $data=$response->toArray();
        return new JsonResponse($data['choices'][0]['message']['content']);
    }

    #[Route('/home', name: 'home')]
    public function home()
    {
        return $this->render('home.html.twig');
    }
}
