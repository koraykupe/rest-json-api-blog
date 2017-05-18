<?php
declare(strict_types=1);

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("/api/article/{id}", name="api_article_show")
     * @Method("GET")
     * @param $id
     * @return JsonResponse
     */
    public function showAction($id) :JsonResponse
    {
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);

        if ($article === null) {
            throw $this->createNotFoundException(sprintf(
                'No article found with "%s id"',
                $id
            ));
            // return new Response("article not found", Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializeArticle($article);
        $response = new JsonResponse($data, 200);
        return $response;
    }

    /**
     * @Route("/api/article/list")
     * @Method("GET")
     */
    public function listAction() :JsonResponse
    {
        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll();

        $data = array('articles' => array());

        foreach ($articles as $article) {
            $data['articles'][] = $this->serializeArticle($article);
        }

        $response = new JsonResponse($data, 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/article")
     * @Method("POST")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request) :JsonResponse
    {
        $requestContent = json_decode($request->getContent(), true);

        $article = new Article();
        $article->setTitle($requestContent['title']);
        $article->setContent($requestContent['content']);

        // Run the Entity Manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $data = $this->serializeArticle($article);

        // Generate the url for created article
        $articleUrl = $this->generateUrl(
            'api_article_show',
            ['id' => $article->getId()]
        );

        // Prepare the response
        $response = new JsonResponse($data, 201);
        // Add location header
        $response->headers->set('Location', $articleUrl);
        // Set content type in header
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Transform Article array into JSON
     * @param Article $article
     * @return array
     */
    private function serializeArticle(Article $article) :array
    {
        return array(
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
        );
    }

}
