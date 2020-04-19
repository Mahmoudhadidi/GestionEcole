<?php

namespace SalleBundle\Controller;

use SalleBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $salle = new Salle();
        $form = $this->createForm('SalleBundle\Form\SalleType', $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();
            $msg=  "la nouvelle salle ".$salle->getNomSalle()." a bien été enregistrée";//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('salle_index',array('msg'=>$msg,));
        }

        $em = $this->getDoctrine()->getManager();

        $salles = $em->getRepository('SalleBundle:Salle')->findAll();

        return $this->render('salle/index.html.twig', array(
            'salles' => $salles,
            'form' => $form->createView(),
        ));    }
}
