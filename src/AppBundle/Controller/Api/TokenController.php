<?php
declare(strict_types=1);

namespace AppBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TokenController extends Controller
{
    /**
     * @Route("/api/tokens")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function newTokenAction(Request $request)
    {
        $requestContent = json_decode($request->getContent(), true);
        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $requestContent['username'],
                'exp' => time() + 3600 // 1 hour expiration
            ]);

        return new JsonResponse(['token' => $token]);
    }

}