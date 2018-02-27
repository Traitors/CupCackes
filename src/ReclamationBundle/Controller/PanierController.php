<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Panier;
use ReclamationBundle\Entity\Lignepanier;
use ReclamationBundle\Entity\Cartefidelite;
use ReclamationBundle\Entity\PanierControllerTest;
use ReclamationBundle\Entity\Solde;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PanierController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paniers = $em->getRepository('ReclamationBundle:Panier')->findAll();

        return $this->render('ReclamationBundle:panier:index.html.twig', array(
            'paniers' => $paniers,
        ));
    }
    public function frontAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user) {
            $paniers = $em->getRepository('ReclamationBundle:Panier')->findBy(array('user'=>$user));
            $line = $em->getRepository('ReclamationBundle:Lignepanier')->findBy(array('panier'=>$paniers));
            $tot = 0;
            foreach ( $line as $line){

                $tot =$tot + $line->getProduit()->getAncienprix();
            }
            $line = $em->getRepository('ReclamationBundle:Lignepanier')->findBy(array('panier'=>$paniers));
            return $this->render('ReclamationBundle:panier:front.html.twig', array(
                'paniers' => $line,
                'tot'=>$tot
            ));
        }else{
            return $this->redirectToRoute('ReclamationBundle:Lignepanier');
        }
    }


    public function newAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('ReclamationBundle:Produit')->find($id);
        $user =$this->getUser();
        $panier = new Panier();
        if ($user){

            $panier = $em->getRepository('ReclamationBundle:Panier')->findBY(array('user'=>$user));

            if ($panier){
                $p = $panier[0];
                $Lignepanier = new Lignepanier();
                $Lignepanier->setProduit($produit);
                $Lignepanier->setPanier($p);
                $em->persist($Lignepanier);
                $em->flush();

            }else{
                $solde = new Solde();
                $carte = new Cartefidelite();
                $carte->setUser($user);
                $carte->setNombrePointFidele(0);
                $em->persist($carte);
                $solde->setUser($user);
                $solde->setSolde(1000);
                $em->persist($solde);
                $em->flush();
                $panier = new Panier();
                $panier->setUser($user);
                $panier->setNombre(0);
                $em->persist($panier);
                $em->flush();
                $panier = $em->getRepository('ReclamationBundle:Panier')->findBY(array('user'=>$user));
                $p = $panier[0];
                $Lignepanier = new Lignepanier();
                $Lignepanier->setProduit($produit);
                $Lignepanier->setPanier($p);
                $em->persist($Lignepanier);
                $em->flush();
            }

        }else{
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->redirectToRoute('panier_front');

    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $panier = $em->getRepository('ReclamationBundle:Panier')->find($id);
        $line = $em->getRepository('ReclamationBundle:Lignepanier')->findBy(array('panier'=>$panier));

        return $this->render('ReclamationBundle:panier:show.html.twig', array(
            'paniers' => $line
        ));
    }



    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $line = $em->getRepository('ReclamationBundle:Lignepanier')->find($id);

        $em = $this->getDoctrine()->getManager();
            $em->remove($line);
            $em->flush();


        return $this->redirectToRoute('panier_front');
    }


}
