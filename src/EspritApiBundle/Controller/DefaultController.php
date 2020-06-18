<?php

namespace EspritApiBundle\Controller;

#use http\Env\Request;
use NotesBundle\Entity\Note;
use EvaliatBundle\Entity\Evaluation;
use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
class DefaultController extends Controller

{
    public static $session;
    public function allAction()
    {
        $notes = $this->getDoctrine()->getManager()->getRepository('NotesBundle:Note')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }

public function find111Action(){

      $id = $session;
    $em = $this->getDoctrine()->getManager();

    $RAW_QUERY = "SELECT *
                      FROM   evaluation
                      where id_enseignant= $session" ;


    $statement = $em->getConnection()->prepare($RAW_QUERY);
    $statement->execute();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($statement);
        return new JsonResponse($formatted);
    }
    public function findByCinAction($cin){
        $notes = $this->getDoctrine()->getManager()->getRepository('NotesBundle:Note')->find($cin);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $notes = new Note();
        $notes->setNoteCc($request->get('noteCc'));
        $notes->setNoteDs($request->get('noteDs'));
        $notes->setNoteExamun($request->get('noteExamun'));
        $notes->setCin($request->get('cin'));
        $notes->setNomMatier($request->get('nomMatier'));
        $em->persist($notes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);

    }

    public function statAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $query1 = 'SELECT  user.username, note.nom_matier, max(note.moyenne) as majeur 
                                   from user, note
                                   WHERE user.id=note.cin 
                                   GROUP by note.nom_matier ;';
        $statement = $em->getConnection()->prepare($query1);
        $statement->execute();
        $result = $statement->fetchAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($result);
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
    public function newUserAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $Users = new User();
        $Users->setUsername($request->get('username'));
        $Users->setEmail($request->get('email'));
        $Users->setPassword($request->get('password'));


        $em -> persist($Users);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Users);
        return new JsonResponse($formatted);
    }

    public function loginAction(Request $request)

    {
        $users = $this->getDoctrine()->getManager()
            ->getRepository(User::class)->findAll();
        foreach ($users as $user) {
            if ($user->getUsername() == $request->get('username')) {
                if ($user->getPassword() == $request->get('password')) {
                    

                    return new JsonResponse(1);

                }
            }
        }
        return new JsonResponse(0);

    }
}
