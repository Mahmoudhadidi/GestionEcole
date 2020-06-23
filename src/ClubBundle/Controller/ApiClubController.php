<?php


namespace ClubBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;




class ApiClubController extends Controller
{
    /**
     *
     * @Rest\Get("/")
     */
    public function apiAction()
    { //$client = HttpClient::create();
        // $response = $client->request('GET', 'http://127.0.0.1:8000');
        if(isset($_GET['nom'])){
            $nom =$_GET['nom'];
            $cof =$_GET['cof'];
            $credit =$_GET['credit'];
            $matiere = new Matiere();
            $matiere->setNomMatier($nom);
            $matiere->setCoefficient($cof);
            $matiere->setCdedit($credit);
            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();
        }
        if(isset($_GET['idMatiere'])){

            $this->getDoctrine()->getRepository('MatiereBundle:Matiere')->supprimerMatiere();
        }
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