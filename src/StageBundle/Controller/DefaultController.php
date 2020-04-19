<?php

namespace StageBundle\Controller;

use StageBundle\Entity\Stage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $stage = new Stage();
        $form = $this->createForm('StageBundle\Form\StageType', $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();

            return $this->redirectToRoute('stage_index');
        }
        if (isset($_GET['idStage'])) {
            $this->getDoctrine()->getRepository('StageBundle:Stage')->supprimerStage();
            return $this->redirectToRoute('stage_index');
        }

        return $this->render('StageBundle:Default:index.html.twig');
    }
}
