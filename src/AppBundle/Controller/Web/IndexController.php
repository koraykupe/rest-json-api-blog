<?php

namespace AppBundle\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IndexController extends Controller
{
    /**
     * List all articles
     * @Route("/articles")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Article:list.html.twig', array(
            // ...
        ));
    }
}
