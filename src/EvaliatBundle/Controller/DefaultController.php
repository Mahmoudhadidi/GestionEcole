<?php

namespace EvaliatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EvaliatBundle:Default:index.html.twig');
    }
}
