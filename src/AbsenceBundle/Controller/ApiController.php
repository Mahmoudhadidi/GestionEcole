<?php


namespace AbsenceBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use AbsenceBundle\Controller\AbsenceController;
use AbsenceBundle\Entity\Absence;


class ApiController extends Controller
{
    /**
     *
     * @Rest\Get("/")
     */
    public function apiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $querry = 'SELECT  * 
                     from absence
                    ;';
        $statement = $em->getConnection()->prepare($querry);
        $statement->execute();

        $absences = $statement->fetchAll();
        $listFanction=array();
        foreach ($absences as $absence) {
            array_push($listFanction,array(
                "id"=> $absence->getIdAbsence(),
                "nom"=> $absence->getIdEtuidant(),
                "justification"=> $absence->getTypeAbsence(),
                "date"=> $absence->getDate(),
            ));

        }

        return new JsonResponse($listFanction) ;



    }

}