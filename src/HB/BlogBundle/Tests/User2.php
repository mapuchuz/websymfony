<?php

namespace HB\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\UserRepository")
 */
class User extends BaseUser implements UserInterface
{
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255)
     *  @Assert\Email(
     *     message = "'{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     */
    protected $email;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom ne peut pas contenir de nombre"
     * )
     * @Assert\Regex(
     *     pattern="/[A-Z]{4}/",
     *     match=true,
     *     message="Votre nom ne peut pas contenir de minus"
     * )
     */
    private $name;

    /**
     * @var string $login
     *
     * @ORM\Column(name="login", type="string", length=255)
     * 
     */
    private $login;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $creationDate;

    /**
     * @var \DateTime $lastEditDate
     *
     * @ORM\Column(name="lastEditDate", type="datetime",  nullable=true)
     * @Assert\DateTime()
     */
    private $lastEditDate;

    /**
     * @var \DateTime $birthDate
     * @ORM\Column(name="birthDate", type="date",  nullable=true)
     * @Assert\DateTime()
     */
    private $birthDate;

    /**
     * @var bool $enabled
     *
     * @ORM\Column(name="enabled", type="string", length=255)
     */
    protected $enabled;

    /**
     *
     * @var Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author") 
     */
    private $articles;
  
       
     /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        // Imaginons que vous avez un tableau de noms bidons

        // Vérifie si le nom est bidon
        if ($this->name=="POPOL") {
            $context->addViolationAt(
                'Name',
                'POPOL n est pas ici !',
                array(),
                null
            );
        }
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastEditDate
     *
     * @param \DateTime $lastEditDate
     * @return User
     */
    public function setLastEditDate($lastEditDate)
    {
        $this->lastEditDate = $lastEditDate;

        return $this;
    }

    /**
     * Get lastEditDate
     *
     * @return \DateTime 
     */
    public function getLastEditDate()
    {
        return $this->lastEditDate;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /**
     * 
     * @return string
     */
    public function getNameLogin() {
        return $this->name."_".$this->login;
    }
        
    
            
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param \HB\BlogBundle\Entity\Article $articles
     * @return User
     */
    public function addArticle(\HB\BlogBundle\Entity\Article $article)
    {
        $this->articles[] = $article;
        $article->setAuthor($this);
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \HB\BlogBundle\Entity\Article $articles
     */
    public function removeArticle(\HB\BlogBundle\Entity\Article $article)
    {
        $article->setAuthor(null);
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
    
        public function eraseCredentials() {

    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function getSalt() {
        return null;
    }

    public function getUsername() {
        return $this->login;        
    }
}
