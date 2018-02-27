<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * 
 */
class Lignepanier {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
         /**
     *@ORM\ManyToOne(targetEntity="ReclamationBundle\Entity\Produit")
     */
    private $produit;
         /**
     *@ORM\ManyToOne(targetEntity="Panier")
     */
    private $panier;



    function getId() {
        return $this->id;
    }

    function getProduit() {
        return $this->produit;
    }

    function getPanier() {
        return $this->panier;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setProduit($produit) {
        $this->produit = $produit;
    }

    function setPanier($panier) {
        $this->panier = $panier;
    }







    



}
