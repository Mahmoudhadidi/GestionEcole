<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     *
     * @Route("/")
     */
    public function indexAction(Request $request)
    {

        $authChecker = $this->container->get('security.authorization_checker');

        if($authChecker->isGranted('ROLE_ETUDIANT')) {

            return $this->render('base1.html.twig');
        }elseif ($authChecker->isGranted('ROLE_ENSEIGNANT')) {
            return $this->render('base.html.twig');
        }elseif ($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->render('adminnote.html.twig');
        }else{

            return $this->render('@FOSUser/Security/login.html.twig');
        }

        // replace this example code with whatever you need
        return $this->render("front.html.twig");

    }

}
