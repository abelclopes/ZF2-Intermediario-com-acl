<?php
namespace ACPLOUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Stdlib\Hydrator;

/**
 * AcplouserUsers
 *
 * @ORM\Table(name="acplouser_users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="ACPLOUser\Entity\UserRepository")
 */
class User
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     *
     * @var string @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    protected $nome;

    /**
     *
     * @var string @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     *
     * @var string @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;

    /**
     *
     * @var string @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    protected $salt;

    /**
     *
     * @var boolean @ORM\Column(name="active", type="boolean", nullable=true)
     */
    protected $active;

    /**
     *
     * @var string @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    protected $activationKey;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    public function __construct(array $option = array())
    {
        (new Hydrator\ClassMethods())->hydrate($option, $this);
        
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        
        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email . $this->salt);
    }

    public function toArray()
    {
        return array(
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "email" => $this->getEmail(),
            "password" => $this->getPassword(),
            "salt" => $this->getSalt(),
            "active" => $this->getActive(),
            "activationKey" => $this->getActivationKey(),
            "updatedAt" => $this->getUpdatedAt(),
            "createdAt" => $this->getCreatedAt()
        );
    }

    public function getId()
    {
       return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
//         return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
       return $this->nome = $nome;
    }

    public function getEmail()
    {
       return $this->email;
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getPassword()
    {
       return $this->password;
    }

    public function setPassword($password)
    {
       return $this->password = $this->encryptPassword($password);
    }

    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password * 2)));
    }

    public function getSalt()
    {
       return $this->salt;
    }

    public function setSalt($salt)
    {
       return $this->salt = $salt;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
       return $this->active = ($active == null) ? NULL : 1;
    }

    public function getActivationKey()
    {
        return $this->activationKey;
    }


    function setActivationKey($activationKey)
    {
       return $this->activationKey = $activationKey;
    }

    public function getUpdatedAt()
    {
      return  $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt()
    {
       return $this->updatedAt = new \DateTime('now');
    }

    public function getCreatedAt()
    {
       return $this->createdAt;
    }

    public function setCreatedAt()
    {
       return $this->createdAt = new \DateTime('now');
    }
}

