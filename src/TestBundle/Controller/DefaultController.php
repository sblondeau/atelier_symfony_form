<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{param}/{nom}", defaults={"param"="Sylvain"})
     * @Template("@Test/Default/index.html.twig")
     */
    public function indexAction($param)
    {
        return ['prenom' => $para ];
        //return $this->render('TestBundle:Default:index.html.twig');
    }
}
