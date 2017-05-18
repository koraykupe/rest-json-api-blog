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
     * @Route("/api/article/{id}", name="api_article_show")
     * @Method("GET")
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find($id);

        if ($article === null) {
            throw $this->createNotFoundException(sprintf(
                'No article found with "%s id"',
                $id
            ));
            // return new Response("article not found", Response::HTTP_NOT_FOUND);
        }

        // Prepare the response data
        $data = array(
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
        );

        $response = new Response(json_encode($data), 200);
        return $response;
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

        // Generate the url for created article
        $articleUrl = $this->generateUrl(
            'api_article_show',
            ['id' => $article->getId()]
        );
        // Add location header
        $response->headers->set('Location', $articleUrl);

        // Set content type in header
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
