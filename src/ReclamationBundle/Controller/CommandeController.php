<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Commande;
use ReclamationBundle\Entity\Panier;
use ReclamationBundle\Entity\Solde;
use ReclamationBundle\Entity\Lignepanier;
use ReclamationBundle\Entity\Cartefidelite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commande controller.
 *
 */
class CommandeController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('ReclamationBundle:Commande')->findAll();

        return $this->render('ReclamationBundle:commande:index.html.twig', array(
            'commandes' => $commandes,
        ));
    }
    public function carteAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('ReclamationBundle:Cartefidelite')->findAll();

        return $this->render('ReclamationBundle:commande:carte.html.twig', array(
            'commandes' => $commandes,
        ));
    }
    public function paymentAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
$solde = new Solde();
        $Cartefidelite = new Cartefidelite();
        $commandes = $em->getRepository('ReclamationBundle:Commande')->find($id);
        $solde = $em->getRepository('ReclamationBundle:Solde')->findBy(array('user'=>$user));

       $n =  $solde[0]->getSolde() - $commandes->getTotal();
       if($n > 0 ){
           $Cartefidelite = $em->getRepository('ReclamationBundle:Cartefidelite')->findBy(array('user'=>$user));
           $solde[0]->setSolde($n);
           $p =  $commandes->getTotal() / 10;
           foreach ( $Cartefidelite as $Cartefidelite) {
               $Cartefidelite->setNombrePointFidele($p);
                $em->persist($Cartefidelite);
           }

           $commandes->setValidation(1);

           $em->flush();
           return $this->render('ReclamationBundle:commande:payervalider.html.twig');
       }else{
           return $this->render('ReclamationBundle:commande:payernonvalider.html.twig', array(
               'commandes' => $commandes,
           ));
       }

    }

    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $paniers = $em->getRepository('ReclamationBundle:Panier')->findBy(array('user'=>$user));
        $line = $em->getRepository('ReclamationBundle:Lignepanier')->findBy(array('panier'=>$paniers));
        $tot = 0;
        foreach ( $line as $line){

            $tot =$tot + $line->getProduit()->getAncienprix();
        }
        $commande = new Commande();
        $form = $this->createForm('ReclamationBundle\Form\CommandeType', $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $commande->setUser($user);
            $commande->setTotal($tot);
            $commande->setValidation(0);
            $em->persist($commande);
            $em->flush();

            return $this->redirectToRoute('payment', array('id' => $commande->getId()));
        }

        return $this->render('ReclamationBundle:commande:new.html.twig', array(
            'commande' => $commande,
            'form' => $form->createView(),
        ));
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('ReclamationBundle:Commande')->find($id);
            $em->remove($commande);
            $em->flush();


        return $this->redirectToRoute('commande_index');
    }
    public function pgfAction()
    {
        $pdfGenerator = $this->get('siphoc.pdf.generator');
         $pdfGenerator->setName('my_pdf.pdf');
        return $pdfGenerator->downloadFromView(
            'ReclamationBundle:commande:index.html.twig'
        );
    }


}
