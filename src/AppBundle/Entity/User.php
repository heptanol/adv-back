<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user", indexes={@Index(name="username_index", columns={"username"})})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Groups({"user"})
     */
    protected $email;
    
    /**
     * @Groups({"user-write"})
     */
    protected $plainPassword;

    /**
     * @Groups({"user"})
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    protected $sex;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $birthDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $aboutMe;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Image
     */
    protected $profilePic;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\Image
     */
    protected $coverPic;

    /**
     * @ORM\OneToMany(targetEntity="Node", mappedBy="user", fetch="EXTRA_LAZY")
     */
    protected $nodes;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="iFollow")
     */
    private $followsMe;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="followsMe")
     * @ORM\JoinTable(name="follows",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="followed_user_id", referencedColumnName="id")}
     *      )
     */
    private $iFollow;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * @param mixed $aboutMe
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    /**
     * @return mixed
     */
    public function getCoverPic()
    {
        return $this->coverPic;
    }

    /**
     * @param mixed $coverPic
     */
    public function setCoverPic($coverPic)
    {
        $this->coverPic = $coverPic;
    }

    /**
     * @return mixed
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic($profilePic)
    {
        $this->profilePic = $profilePic;
    }

    /**
     * @return mixed
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param mixed $nodes
     */
    public function setNodes($nodes)
    {
        $this->nodes = $nodes;
    }
    

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }

    /**
     * @return mixed
     */
    public function getFollowsMe()
    {
        return $this->followsMe;
    }

    /**
     * @param mixed $followsMe
     */
    public function setFollowsMe($followsMe)
    {
        $this->followsMe = $followsMe;
    }

    /**
     * @return mixed
     */
    public function getIFollow()
    {
        return $this->iFollow;
    }

    /**
     * @param mixed $iFollow
     */
    public function setIFollow($iFollow)
    {
        $this->iFollow = $iFollow;
    }

   
}