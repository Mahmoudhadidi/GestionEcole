<?php

namespace AbsenceEmployeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AbsenceEmployeBundle:Default:index.html.twig');
    }
}
