<?php

namespace ReclamationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_RI", columns={"categorie"})})
 * @ORM\Entity
 */
class Produit
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
     * @var integer
     *
     * @ORM\Column(name="categorie", type="integer", nullable=true)
     */
    private $categorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateajout", type="date", nullable=false)
     */
    private $dateajout;

    /**
     * @var float
     *
     * @ORM\Column(name="ancienprix", type="float", precision=10, scale=0, nullable=false)
     */
    private $ancienprix;

    /**
     * @var float
     *
     * @ORM\Column(name="nvprix", type="float", precision=10, scale=0, nullable=false)
     */
    private $nvprix;

    /**
     * @var string
     *
     * @ORM\Column(name="nomp", type="string", length=50, nullable=false)
     */
    private $nomp;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var integer
     *
     * @ORM\Column(name="ptfidelite", type="integer", nullable=false)
     */
    private $ptfidelite;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estAchete", type="boolean", nullable=false)
     */
    private $estachete;

    /**
     * @var string
     *
     * @ORM\Column(name="product_img", type="string", length=300, nullable=true)
     */
    private $productImg;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @return int
     */

    /**
     * @var \Symfony\Bridge\Doctrine\Security\User\EntityUserProvider
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAgent", referencedColumnName="id")
     * })
     */
    private $idAgent;

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
     * @return int
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param int $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return \DateTime
     */
    public function getDateajout()
    {
        return $this->dateajout;
    }

    /**
     * @param \DateTime $dateajout
     */
    public function setDateajout($dateajout)
    {
        $this->dateajout = $dateajout;
    }

    /**
     * @return float
     */
    public function getAncienprix()
    {
        return $this->ancienprix;
    }

    /**
     * @param float $ancienprix
     */
    public function setAncienprix($ancienprix)
    {
        $this->ancienprix = $ancienprix;
    }

    /**
     * @return float
     */
    public function getNvprix()
    {
        return $this->nvprix;
    }

    /**
     * @param float $nvprix
     */
    public function setNvprix($nvprix)
    {
        $this->nvprix = $nvprix;
    }

    /**
     * @return string
     */
    public function getNomp()
    {
        return $this->nomp;
    }

    /**
     * @param string $nomp
     */
    public function setNomp($nomp)
    {
        $this->nomp = $nomp;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function getPtfidelite()
    {
        return $this->ptfidelite;
    }

    /**
     * @param int $ptfidelite
     */
    public function setPtfidelite($ptfidelite)
    {
        $this->ptfidelite = $ptfidelite;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return bool
     */
    public function isEstachete()
    {
        return $this->estachete;
    }

    /**
     * @param bool $estachete
     */
    public function setEstachete($estachete)
    {
        $this->estachete = $estachete;
    }

    /**
     * @return string
     */
    public function getProductImg()
    {
        return $this->productImg;
    }

    /**
     * @param string $productImg
     */
    public function setProductImg($productImg)
    {
        $this->productImg = $productImg;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    /**
     * @return \Symfony\Bridge\Doctrine\Security\User\EntityUserProvider
     */
    public function getIdAgent()
    {
        return $this->idAgent;
    }

    /**
     * @param \Symfony\Bridge\Doctrine\Security\User\EntityUserProvider $idAgent
     */
    public function setIdAgent($idAgent)
    {
        $this->idAgent = $idAgent;
    }



}

