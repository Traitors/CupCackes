<?php
namespace ReclamationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * 
 */
class Cartefidelite {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $idCarteFidelite;
    
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $user;
        /**
     * @ORM\Column(type="integer")
     * 
     */
    private $nombrePointFidele;
    public function getIdCarteFidelite() {
        return $this->idCarteFidelite;
    }

    public function getNombrePointFidele() {
        return $this->nombrePointFidele;
    }

    public function setIdCarteFidelite($idCarteFidelite) {
        $this->idCarteFidelite = $idCarteFidelite;
    }

    public function setNombrePointFidele($nombrePointFidele) {
        $this->nombrePointFidele = $nombrePointFidele;
    }
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }



    	
    
}
