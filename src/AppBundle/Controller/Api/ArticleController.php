<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * @Route("/api/article/{id}")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);

        if ($article === null) {
            return new Response("article not found", Response::HTTP_NOT_FOUND);
        }

        $response['data'] = array(
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
        );

        return new Response(json_encode($response), 200);
    }

    /**
     * @Route("/api/list")
     * @Method("GET")
     */
    public function listAction()
    {
    }

    /**
     * @Route("/api/article")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $article->setTitle($request->get('title'));
        $article->setContent($request->get('content'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $response = new Response('Created!', 201);
        // Add location header
        $response->headers->set('Location', '/api/article/id');

        return $response;
    }

}
