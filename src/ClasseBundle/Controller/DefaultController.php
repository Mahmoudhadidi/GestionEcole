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

            $msg=  " classe ".$classe->getNumClasse()." a bien été enregistrée";//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('classe_homepage',array('msg'=>$msg,));
        }
        if(isset($_POST['submit'])){
            extract($_POST);

            $i=$_POST['i'];
            $idclasse=$_POST['idclasse'];

            for ($j=0;$j<$i;$j++)
            {
                if(isset($_POST['chek'.$j])){
                    $etu=$_POST['chek'.$j];
                    $this->getDoctrine()->getRepository('UserBundle:User')->editAffect($idclasse,$etu);


            }}

            $msg=  " les etudiants a bien été affectée à la classe ".$_POST['nomclasse'];//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('classe_homepage',array('msg'=>$msg,));

            }
        return $this->render('ClasseBundle:Default:index.html.twig');
    }
}
