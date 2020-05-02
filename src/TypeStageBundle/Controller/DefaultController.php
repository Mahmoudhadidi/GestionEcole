<?php

namespace TypeStageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TypeStageBundle:Default:index.html.twig');
    }
}
