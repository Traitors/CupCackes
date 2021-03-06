<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Reclamation;
use ReclamationBundle\Entity\ReclamationSujetSearch;
use ReclamationBundle\Entity\Reponsereclamation;
use ReclamationBundle\Entity\ReponseTraite;
use ReclamationBundle\Entity\traitereclamation;
use ReclamationBundle\Form\Form;
use ReclamationBundle\Form\ReclamationType;
use ReclamationBundle\ReclamationBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

class ReclamationController extends Controller
{

    public function AfficheAction()
    {


        $m = $this->getDoctrine()->getManager();
        $Produit = $m->getRepository("ReclamationBundle:Produit")->findAll();


        return $this->render('ReclamationBundle:Reclamtion:AfficheProduit.html.twig', array(
            'produit' => $Produit
        ));
    }


    public function ReclamationAction($id, \Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = new Reclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $name = $user->getUsername();
        $produit = $em->getRepository('ReclamationBundle:Produit')->find($id);
        $reclamation->setIdclient($user);
        $reclamation->setProduit($produit);
        $date = (date('Y-m-d'));
        $reclamation->setDatereclamation($date);
        $reclamation->setStatusreclamation("En cours");

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($reclamation);
            $em->flush();

            //var_dump($reclamation->getIdreclamation());exit();

            return $this->redirectToRoute('reclamation_Affiche', array('id' => $id));
        }

        return $this->render('ReclamationBundle:Reclamtion:Ajoutreclamation.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
            'name' => $name
        ));
    }


    public function detailsUserAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();


        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $reclamation = $em->getRepository('ReclamationBundle:Reclamation')->find(array("idreclamation" => $id));
        $reclamationReponse = $em->getRepository('ReclamationBundle:Reponsereclamation')->findOneBy(array("idreclamation" => $id));


        $recl = $em->getRepository('ReclamationBundle:Reclamation')->findBy(array("idclient" => $this->getUser()->getId()));


        $name = $user->getUsername();
        $produit = $em->getRepository('ReclamationBundle:Produit')->find($id);
        //var_dump($id);exit();


        return $this->render('ReclamationBundle:Reclamtion:detailsReclamationUser.html.twig', array(
            'reclamation' => $reclamation,
            'name' => $name,
            'produit' => $produit,
            'reponse' => $reclamationReponse,
            'reclamations' => $recl
        ));
    }

    public function userDashAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $name = $user->getUsername();

        $recl = $em->getRepository('ReclamationBundle:Reclamation')->findBy(array("idclient" => $this->getUser()->getId()));
        return $this->render('ReclamationBundle:Reclamtion:AfficheReclamation1.html.twig', array(

            'name' => $name,
            'reclamations' => $recl

        ));
    }

    public function indexAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->findAll();
        $name = $user->getUsername();

        $reclamationSearch = new ReclamationSujetSearch();
        $form1 = $this->createForm('ReclamationBundle\Form\ReclamationSearchType', $reclamationSearch);
        $form1->handleRequest($request);

        if ($form1->isValid()) {


            $query = $this->getDoctrine()->getRepository('ReclamationBundle:Reclamation')->findBy(array('sujetreclamation' => $form1->getData()));

            $res = $query->getResult();
        }
        return $this->render('ReclamationBundle:Reclamtion:AfficheAdminReclamation.html.twig', array(
            'reclamations' => $reclamations,
            'name' => $name,
            'form' => $form1->createView(),
        ));
    }


    public function detailsAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();


        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $reclamation = $em->getRepository('ReclamationBundle:Reclamation')->find(array("idreclamation" => $id));
        $reclamationReponse = $em->getRepository('ReclamationBundle:Reponsereclamation')->findOneBy(array("idreclamation" => $id));
        $name = $user->getUsername();
        $produit = $em->getRepository('ReclamationBundle:Produit')->find($id);

        return $this->render('ReclamationBundle:Reclamtion:detailsReclamation.html.twig', array(
            'reclamation' => $reclamation,
            'name' => $name,
            'produit' => $produit,
            'reponse' => $reclamationReponse
        ));

    }

    public function createAction(\Symfony\Component\HttpFoundation\Request $request, $idreclamation)
    {
        $em = $this->getDoctrine()->getManager();
        $reponse = new Reponsereclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReponseReclamationForm', $reponse);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));


        $name = $user->getUsername();
        $reclamation = $em->getRepository('ReclamationBundle:Reclamation')->find($idreclamation);

        $date = (date('Y-m-d'));
        $reponse->setdatereponse($date);
        $reponse->setIdadmin($user);
        $reponse->setIdreclamation($reclamation);
        $reclamation->setStatusreclamation("Traitée");

        if ($form->isSubmitted() && $form->isValid()) {


            $em->persist($reponse);
            $em->flush();


            //var_dump($reclamation->getIdreclamation());exit();

            return $this->redirectToRoute('reclamation_display');
        }

        return $this->render('ReclamationBundle:Reclamtion:createReponseReclamation.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
            'name' => $name
        ));

    }


    public function deleteAction($idreclamation)
    {

        $em = $this->getDoctrine()->getManager();

        $reclamation = $em->getRepository("ReclamationBundle:Reclamation")->find($idreclamation);
        $em->remove($reclamation);
        $em->flush();
        return $this->redirectToRoute('reclamation_display');
    }


    public function searchAction(\Symfony\Component\HttpFoundation\Request $request, $sujet)
    {

        $em = $this->getDoctrine()->getManager();
        $reclamationSearch = new ReclamationSujetSearch();
        $form = $this->createForm('ReclamationBundle\Form\ReclamationsearchType', $reclamationSearch);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->findBy(array("id" => $this->getUser()->getId()));


        if ($form->isValid()) {

            $query = $this->getDoctrine()->getRepository('ReclamationBundle:Reclamation')->search($form->getData()->getSujet());
            $results = $query->getResult();

        }

        return $this->render('ReclamationBundle:Reclamtion:AfficheAdminReclamation.html.twig', array(
            'reclamations' => $results,
            'name' => $user->getUsername(),
            'form' => $form->createView(),
        ));
    }


    public function TraiterAction($id, $id1, \Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = new traitereclamation();
        $form = $this->createForm('ReclamationBundle\Form\TraitereclamationType', $reclamation);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $name = $user->getUsername();
        $produit = $em->getRepository('ReclamationBundle:Reclamation')->find($id);
        $reclamation->setIdreclamation($produit);
        $produit ->setStatusreclamation("Terminer");
        $user1 = $em->getRepository('UserBundle:User')->find($id1);
        $reclamation->setStatustraite("En cours");
        $reclamation->setIdagent($user1);
        $reclamation->setIdadmin($user);
        $date = (date('Y-m-d'));
        $reclamation->setdatetraite($date);


        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($reclamation);
            $em->flush();

            //var_dump($reclamation->getIdreclamation());exit();

            return $this->redirectToRoute('reclamation_display', array('id' => $id));
        }

        return $this->render('ReclamationBundle:Reclamtion:AjoutTraite.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
            'name' => $name
        ));
    }


    public function TraiteafficheAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $name = $user->getUsername();

        $recl = $em->getRepository('ReclamationBundle:traitereclamation')->findBy(array("idagent" => $this->getUser()->getId()));
        return $this->render('ReclamationBundle:Reclamtion:AffichereclamationAgent.html.twig', array(

            'name' => $name,
            'reclamations' => $recl

        ));
    }

    public function TraiterepondreAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $reponse = new ReponseTraite();
        $form = $this->createForm('ReclamationBundle\Form\ReponseTraiteType', $reponse);
        $form->handleRequest($request);
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));


        $name = $user->getUsername();
        $reclamation = $em->getRepository('ReclamationBundle:traitereclamation')->find($id);

        $date = (date('Y-m-d'));
        $reponse->setdatereponse($date);
        $reponse->setIdtraite($reclamation);
        $reclamation->setStatustraite("Traitée");
        $reclamation->setStatustraite("Traitée");

        if ($form->isSubmitted() && $form->isValid()) {


            $em->persist($reponse);
            $em->flush();


            //var_dump($reclamation->getIdreclamation());exit();

            return $this->redirectToRoute('agenttrite');
        }

        return $this->render('ReclamationBundle:Reclamtion:createReponsetraite.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
            'name' => $name
        ));


    }
    public function TraiteafficheadminAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $reclamations = $em->getRepository('ReclamationBundle:ReponseTraite')->findAll();
        $name = $user->getUsername();
        return $this->render('ReclamationBundle:Reclamtion:AffichetraiteAdmin.html.twig', array(
            'reclamations' => $reclamations,
            'name' => $name,
        ));
    }

    public function detailsAgentAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();


        $user = $em->getRepository('UserBundle:User')->find(array("id" => $this->getUser()->getId()));
        $reclamation = $em->getRepository('ReclamationBundle:traitereclamation')->find(array("id" => $id));
        $reclamationReponse = $em->getRepository('ReclamationBundle:ReponseTraite')->findOneBy(array("idtraite" => $id));


        $recl = $em->getRepository('ReclamationBundle:traitereclamation')->findBy(array("idagent" => $this->getUser()->getId()));


        $name = $user->getUsername();
        $produit = $em->getRepository('ReclamationBundle:Produit')->find($id);
        //var_dump($id);exit();


        return $this->render('ReclamationBundle:Reclamtion:detailsTraiteAgent.html.twig', array(
            'reclamation' => $reclamation,
            'name' => $name,
            'produit' => $produit,
            'reponse' => $reclamationReponse,
            'reclamations' => $recl
        ));
    }







}