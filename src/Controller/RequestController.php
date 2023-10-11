<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function index(): JsonResponse
    {
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
                        'content' => 'tes un humain et ton  ',
                    ],
                ],
            ],
        ]);

        return new JsonResponse($response->toArray());
    }
}
