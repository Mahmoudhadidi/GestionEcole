<?php

namespace ClasseBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use ClasseBundle\Controller\ClasseController;
use ClasseBundle\Entity\Classe;


class ApiclasseController extends Controller
{
    
   

   
    /**
     *
     * @Rest\Get("/")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $classes = $em->getRepository('ClasseBundle:Classe')->findAll();
       $listFanction=array();
        foreach ($classes as $idC) {
            array_push($listFanction,array(
          "id"=> $idC->getIdClasse(),
          "nom"=> $idC->getNumClasse(),
          "NbreEtudient"=> $idC->getNbreEtudient(),
          "Specialite"=> $idC->getSpecialite(),
                
            ));

        }

        return new JsonResponse($listFanction) ;



    }

}
