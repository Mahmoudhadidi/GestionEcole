<?php

namespace EspritApiBundle\Controller;

#use http\Env\Request;
use AbsenceBundle\Entity\Absence;

use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;


class DefaultController extends Controller
{
    public function allAction()
    {
        $notes = $this->getDoctrine()->getManager()->getRepository('AbsenceBundle:Absence')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }
    public function findAction($id){
        $notes = $this->getDoctrine()->getManager()->getRepository('AbsenceBundle:Absence')->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }

    public function findByCinAction($cin){
        $notes = $this->getDoctrine()->getManager()->getRepository('AbsenceBundle:Absence')->find($cin);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $notes = new Absence();
        $notes->setIdSeance($request->get('idSeance'));
        $notes->setIdEtudiant($request->get('idEtudiant'));
        $notes->setTypeAbsence($request->get('typeAbsence'));
        $notes->setDate($request->get('date'));
        $em->persist($notes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);

    }



    #----------------------------------partie spécifique au gestion d'evaluation ----------------------

    public function all1Action()
    {
        $notes = $this->getDoctrine()->getManager()->getRepository('EvaliatBundle:Evaluation')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }
	
	
    public function new1Action(Request $request){

        $em = $this->getDoctrine()->getManager();
        $notes = new Evaluation();
        $notes->setIdEtd($request->get('idEtd'));
        $notes->setPresence($request->get('presence'));
        $notes->setRendement($request->get('rendement'));
        $notes->setDiscipline($request->get('discipline'));
        $notes->setNomMatiere($request->get('nomMatiere'));
		$notes->setIdEnseignant($request->get('idEnseignant'));
        $em->persist($notes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);

    }
}
