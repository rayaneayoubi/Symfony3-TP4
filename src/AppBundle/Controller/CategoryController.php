<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

    /**
     * @Route("/category")
     */
class CategoryController extends Controller
{
    /**
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Category:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction()
    {
        return $this->render('AppBundle:Category:add.html.twig', array(
            // ...
        ));
    }

}
