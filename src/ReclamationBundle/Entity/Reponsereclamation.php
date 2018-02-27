<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponsereclamation
 *
 * @ORM\Table(name="reponsereclamation", indexes={@ORM\Index(name="idadmin", columns={"idadmin"}), @ORM\Index(name="idreclamation", columns={"idreclamation"})})
 * @ORM\Entity
 */
class Reponsereclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=200, nullable=false)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=200, nullable=false)
     */
    private $reponse;

    /**
     * @var \ReclamationBundle\Entity\Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idreclamation", referencedColumnName="idReclamation")
     * })
     */
    private $idreclamation;

    /**
     * @var \Symfony\Bridge\Doctrine\Security\User\EntityUserProvider
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idadmin", referencedColumnName="id")
     * })
     */
    private $idadmin;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param string $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param string $reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;
    }

    /**
     * @return \ReclamationBundle\Entity\Reclamation
     */
    public function getIdreclamation()
    {
        return $this->idreclamation;
    }

    /**
     * @param \ReclamationBundle\Entity\Reclamation $idreclamation
     */
    public function setIdreclamation($idreclamation)
    {
        $this->idreclamation = $idreclamation;
    }

    /**
     * @return \Symfony\Bridge\Doctrine\Security\User\EntityUserProvider
     */
    public function getIdadmin()
    {
        return $this->idadmin;
    }

    /**
     * @param \UserBundle\Entity\User $idadmin
     */
    public function setIdadmin($idadmin)
    {
        $this->idadmin = $idadmin;
    }


}

