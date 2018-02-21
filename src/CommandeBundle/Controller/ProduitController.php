<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 18/02/2018
 * Time: 02:44
 */

namespace CommandeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends  Controller
{
  function  ListAction(){

      $em=$this->getDoctrine()->getManager();
      $produit = $em->getRepository('CommandeBundle:Produit')->findAll();


      return $this->render('CommandeBundle:Default:produit/layout/produit.html.twig', array('produit' => $produit));
  }
}