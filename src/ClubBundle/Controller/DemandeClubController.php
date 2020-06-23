<?php


namespace ClubBundle\Controller;


use ClubBundle\Entity\DemandeClub;
use ClubBundle\Entity\Club;
use ClubBundle\Entity\Evenement;
use ClubBundle\Form\DemandeClubType;
use ClubBundle\Form\ClubType;
use ClubBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\User;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DemandeClubController extends Controller
{
    public function AjoutFormAction(Request $request)
    {
        //return $this->render("@Club/EnvoyerDemandeClub.html.twig");
        return $this->render("@Club/EnvoyerDemandeClub.html.twig");

    }
    public function ajoutmobileAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        $nom = $request->get("nom");
        $description = $request->get("description");
        $domaine = $request->get("domaine");
        $demandeClub = new DemandeClub();

        $demandeClub->setIdEtudiant(2);
        $demandeClub->setNomClub($nom);
        $demandeClub->setDomaine($domaine);
        $demandeClub->setDescription($description);
        $demandeClub->setEtat("non valide");

        $em->persist($demandeClub);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($demandeClub);
        return new JsonResponse($formatted);


    }




    public function ajoutAction(Request $request){

        $demandeClub = new DemandeClub();

        //$form = $this->createForm(DemandeClubType::class,$demandeClub);
        //$form->handleRequest($request);

        $this->addFlash(
            'notice',
            'la session est lancée avec succes'
        );
        if ($request->isMethod('GET'))
        {
            $em=$this->getDoctrine()->getManager();
            //$demandeClub->setIdEtudiant($request->get('idEtudiant'));

            $id1= $this->getUser()->getId();
            $id=intval($id1);

            $demandeClub->setIdEtudiant($id);
            $demandeClub->setNomClub($request->get('nomClub'));
            $demandeClub->setDomaine($request->get('Domaine'));
            $demandeClub->setDescription($request->get('Description'));
            $demandeClub->setEtat("non valide");
            //$demandeClub->setNomImage($request->get('Description'));
            $em->persist($demandeClub);
            $em->flush();
            //return $this->render("@Club/EnvoyerDemandeClub.html.twig");

            return $this->redirectToRoute("club_EnvoyerDemandeClubForm");
        }

        //return $this->render("@Club/EnvoyerDemandeClub.html.twig");
        return $this->redirectToRoute("club_EnvoyerDemandeClubForm");

/*
       if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $demandeClub->uploadProfilePicture();

            $demandeClub->setEtat("non valide");
            $em->persist($demandeClub);
            $em->flush();
            return $this->redirectToRoute("club_EnvoyerDemandeClubPage");
        }

        return $this->render("@Club/EnvoyerDemandeClub.html.twig",array(
            'form'=>$form->createView()
        ));              */
    }

    public function listAction(){
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository("ClubBundle:DemandeClub")->findAll();
        return $this->render("@Club/ListDemandeClub.html.twig",array('demandes'=>$demandes));


    }
    public function affichemobileAction(){
        $em=$this->getDoctrine()->getManager();
        $demandes=$em->getRepository("ClubBundle:DemandeClub")->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted=$serializer->normalize($demandes);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request, $id){

        $demandeClub = new DemandeClub();
        $em=$this->getDoctrine()->getManager();
        $demandeClub=$em->getRepository("ClubBundle:DemandeClub")->find($id);
        $em->remove($demandeClub);
        $em->flush();
        return $this->redirectToRoute("demande_club_AfficheDemandeClub");
    }

    public function detailsAction($id){

        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        return $this->render("@Club/details_user.html.twig", array('user' => $user));
        //return $this->render("@Club/ListDemandeClub.html.twig", array('user' => $user));


    }
    public function mailingAction(Request $request,$mail,$nom){
        $date   = $request->get('daaa');
        //$contenu="Bienvenu monsieur , Votre RDV est fixée a la date du :";
        $username="mohamedzakaria.boutamine@esprit.tn";


        if ($request->isMethod('GET')) {
            //$contenu = $request->get('contenu');
            $date = $request->get('daaa');
            $message = \Swift_Message::newInstance()
                ->setSubject('Concernant votre Demande')
                ->setFrom($username)
                ->setTo($mail)
                ->setBody("Bonjour $nom , concernant votre demande de club , doit venir au bureau de service etudiants au bloc C , le : $date");
            $this->get('mailer')->send($message);
            //{        var_dump($contenu).die();  }

            return $this->redirectToRoute("demande_club_AfficheDemandeClub");
        }
    }

    public function validerAction(Request $request, $id){
        $c = new Club();



        if ($request->isMethod('GET')) {

            $c->setId('4');
            $c->setIdEtudiant($id);
            $c->setNom($request->get('nom' ));
            $c->setPhotoCouverture('photo_cov.png');
            $c->setLogo('logo_p.png');
            $c->setSlogan('Votre Slogan');
            $c->setGrandTitre('aaaaaaaaaaaaaaaaaaaaaa');

            $c->setDescription("La chance existe en dehors de tout contrôle qu'une personne peut exercer sur un événement et sur son résultat. il faut néanmoins un individu pour la qualifier de chance et en faire une lecture positive, autrement cela n'est qu'un événement sans aucun sens, pour personne.
            Si un individu se sent visé par l'événement, on peut alors considérer que la chance existe de façon magique. Certains croient qu'une personne a de la chance, la cultive ou la provoque. La chance peut donc être qualifiée de manière irrationnelle");

            $c->setMail('Club.Exemple@gmail.com');
            $c->setEtat('private');

        }


        $m=$this->getDoctrine()->getManager();
        $demande= $m->getRepository(DemandeClub::class)->find($request->get('demande'));
        $demande->setEtat("valide");
        $m->persist($c);
        $m->persist($demande);
        $m->flush();

        return $this->redirectToRoute("demande_club_AfficheDemandeClub");

    }

    public function afficheProfilAction($id){

        $club = new Club();
        $evenement= new Evenement();
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Club::class)->find($id);
        //$evenement = $em->getRepository(Evenement::class)->find($id);
        $evenement=$em->getRepository("ClubBundle:Evenement")->findAll($id);

        return $this->render("@Club/ProfilPage.html.twig", array('club' => $club ,'evenement' =>$evenement));
        //return $this->render("@Club/ListDemandeClub.html.twig", array('user' => $user));


    }
    public function ModifierProfileAction(Request $request,$id)
    {
        //$Demande = new Club();
        $em = $this->getDoctrine()->getManager();
            $Demande=$em->getRepository("ClubBundle:Club")->find($id);

        $form = $this->createForm(ClubType::class,$Demande);
        $form->handleRequest($request);


        if($form->isSubmitted())
        {

            //$em=$this->getDoctrine()->getManager();
            $em->persist($Demande);
            $em->flush();
            //return $this->redirectToRoute("club_afficher_profil");
            //return $this->render("@Club/modifier.html.twig");

        }
        return $this->render("@Club/modifier.html.twig",array(
            'form'=>$form->createView()
        ));

    }


    public function ajoutEventAction(Request $request){

        $evenement = new Evenement();

        $form = $this->createForm(EvenementType::class,$evenement);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $evenement->uploadProfilePicture();
            $evenement->setLogo("logo_p.png");
            $evenement->setNomClub("Zakaria Boutamine");
            $em->persist($evenement);
            $em->flush();
            return $this->redirectToRoute("event_AjouterEvenementPage");
        }

        return $this->render("@Club/Ajouter_Evenement.html.twig",array(
            'form'=>$form->createView()
        ));
    }
    public  function exportAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Evaluations= $em->getRepository('ClubBundle:DemandeClub')->findAll();
        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['idEtudiant', 'nomClub', 'domaine','description']);
        foreach ($Evaluations as $eval){

            $csv->insertOne([$eval->getIdEtudiant(), $eval->getNomClub(), $eval->getDomaine(), $eval->getDescription()]);
        }

        $csv->output('Evaluations.csv');
        die('export');
    }




}