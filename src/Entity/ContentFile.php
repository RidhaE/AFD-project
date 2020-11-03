<?php



namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;



/**

 * @ORM\Table(name="contentFile")

 * @ORM\Entity(repositoryClass="App\Repository\ContentFileRepository")

 * @ORM\HasLifecycleCallbacks()

 */

class ContentFile

{

    /**

     * @var int

     *

     * @ORM\Column(name="id", type="integer")

     * @ORM\Id

     * @ORM\GeneratedValue(strategy="AUTO")

     */

    private $id;


   /**

     * @var string
     * @ORM\Column(name="identifiant", type="string", length=255)
     */

    private $identifiant;


    /**

     * @var string
     * @ORM\Column(name="nomprenon", type="string", length=255)
     */

    private $nomprenon;


    /**
     * @var string
     * @ORM\Column(name="codebancque", type="string", length=255)
     */

    private $codebancque;

    /**
     * @var string
     * @ORM\Column(name="nombanque", type="string", length=255)
     */

    private $nombanque;


    /**
     * @var string
     * @ORM\Column(name="codeguichet", type="string", length=255)
     */

    private $codeguichet;


      /**
     * @var string
     * @ORM\Column(name="numcompte", type="string", length=255)
     */

    private $numcompte;

    /**
     * @var string
     * @ORM\Column(name="montant", type="string", length=255)
     */

    private $montant;


       /**
     * @var string
     * @ORM\Column(name="motif", type="string", length=255)
     */

    private $motif;

    /**

     * @var \DateTime

     *

     * @ORM\Column(name="create_at", type="datetime", nullable=false)

     */

    private $createAt;


   

    


    /**

     * @var Image

     *

     * @ORM\ManyToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})

     * @ORM\JoinColumn(nullable=false, name="image_id")

     * @Assert\Valid

     */

    private $image;



    


    public function getId(): ?int

    {

        return $this->id;

    }



 



    /**

     * @ORM\PrePersist

     */

    public function setCreateAt(): self

    {

        $this->createAt = new \DateTime();



        return $this;

    }



    public function getCreateAt(): ?\DateTime

    {

        return $this->createAt;

    }


 

    public function setImage(Image $image = null): self

    {

        $this->image = $image;



        return $this;

    }



    public function getImage(): ?Image

    {

        return $this->image;

    }



   


    /**
     * Get the value of identifiant
     */ 
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Set the value of identifiant
     *
     * @return  self
     */ 
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get the value of nomprenon
     */ 
    public function getNomprenon()
    {
        return $this->nomprenon;
    }

    /**
     * Set the value of nomprenon
     *
     * @return  self
     */ 
    public function setNomprenon($nomprenon)
    {
        $this->nomprenon = $nomprenon;

        return $this;
    }

    /**
     * Get the value of codebancque
     */ 
    public function getCodebancque()
    {
        return $this->codebancque;
    }

    /**
     * Set the value of codebancque
     *
     * @return  self
     */ 
    public function setCodebancque($codebancque)
    {
        $this->codebancque = $codebancque;

        return $this;
    }

    /**
     * Get the value of codeguichet
     */ 
    public function getCodeguichet()
    {
        return $this->codeguichet;
    }

    /**
     * Set the value of codeguichet
     *
     * @return  self
     */ 
    public function setCodeguichet($codeguichet)
    {
        $this->codeguichet = $codeguichet;

        return $this;
    }

    /**
     * Get the value of numcompte
     */ 
    public function getNumcompte()
    {
        return $this->numcompte;
    }

    /**
     * Set the value of numcompte
     *
     * @return  self
     */ 
    public function setNumcompte($numcompte)
    {
        $this->numcompte = $numcompte;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of motif
     */ 
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set the value of motif
     *
     * @return  self
     */ 
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get the value of nombanque
     */ 
    public function getNombanque()
    {
        return $this->nombanque;
    }

    /**
     * Set the value of nombanque
     *
     * @return  self
     */ 
    public function setNombanque($nombanque)
    {
        $this->nombanque = $nombanque;

        return $this;
    }
}

