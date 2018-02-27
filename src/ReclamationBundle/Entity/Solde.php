<?php

namespace ReclamationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * 
 */
class Solde {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $solde;
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getSolde() {
        return $this->solde;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setSolde($solde) {
        $this->solde = $solde;
    }


    
}
