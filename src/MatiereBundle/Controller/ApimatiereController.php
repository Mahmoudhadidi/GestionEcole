<?php


namespace MatiereBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use MatiereBundle\Controller\MatiereController;
use MatiereBundle\Entity\Matiere;


class ApimatiereController extends Controller
{
    /**
     *
     * @Rest\Get("/")
     */
    public function apiAction()
    {
        $em = $this->getDoctrine()->getManager();
        $matieres = $em->getRepository('MatiereBundle:Matiere')->findAll();
        $listFanction=array();
        foreach ($matieres as $matiere) {
            array_push($listFanction,array(
                "id"=> $matiere->getIdMatiere(),
                "nom"=> $matiere->getNomMatier(),
                "coefficient"=> $matiere->getCoefficient(),
                "credit"=> $matiere->getCdedit(),
            ));

        }

        return new JsonResponse($listFanction) ;



    }

}