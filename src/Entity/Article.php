<?php



namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;



/**

 * @ORM\Table(name="article")

 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")

 * @ORM\HasLifecycleCallbacks()

 */

class Article

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

     * @var \DateTime

     *

     * @ORM\Column(name="create_at", type="datetime", nullable=false)

     */

    private $createAt;



 



    /**

     * @var User

     *

     * @ORM\ManyToOne(targetEntity="App\Entity\User")

     * @ORM\JoinColumn(nullable=false, name="user_id")

     */

    private $author;



 



    /**

     * @var Image

     *

     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})

     * @ORM\JoinColumn(nullable=true)

     * @Assert\Valid

     */

    private $image;



 



    public function __construct()

    {

 

    }



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



    public function getAuthor(): ?User

    {

        return $this->author;

    }



    public function setAuthor(User $author): self

    {

        $this->author = $author;



        return $this;

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



    

    public function getSlug(): ?string

    {

        return $this->slug;

    }

}

