<?php
namespace ReclamationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * 
 */
class Commande {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

        /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $pays;
        /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $ville;
        /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $codepostale;
        /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $numtel;
        /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $email;
    /**
     * @ORM\Column(type="integer")
     *
     */
    private $total;
            /**
     * @ORM\Column(type="integer")
     * 
     */
    private $validation;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param mixed $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getCodepostale()
    {
        return $this->codepostale;
    }

    /**
     * @param mixed $codepostale
     */
    public function setCodepostale($codepostale)
    {
        $this->codepostale = $codepostale;
    }

    /**
     * @return mixed
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * @param mixed $numtel
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @param mixed $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    
}
