<?php

namespace ClasseBundle\Controller;

use ClasseBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm('ClasseBundle\Form\ClasseType', $classe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('classe_homepage');
        }
        return $this->render('ClasseBundle:Default:index.html.twig');
    }
}
