<?php

namespace TestBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="TestBundle\Repository\UserRepository")
 */
class Insecte extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /** @Orm\Column(type="integer") */
    protected $age;
    /**
     * @ORM\Column(name="famille", type="string", length=255)
     */
    protected $famille;
    /**
     * @ORM\Column(name="race", type="string", length=255)
     */
    protected $race;
    /**
     * @ORM\Column(name="nourriture", type="string", length=255)
     */
    protected $nourriture;

    /**
     * @ORM\ManyToMany(targetEntity="TestBundle\Entity\Insecte")
     * @ORM\JoinTable(name="amis")
     */
    private $insectes;

    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $myInsectes
     * @ORM\ManyToMany(targetEntity="TestBundle\Entity\Insecte", mappedBy="insectes")
     */
    protected $myInsectes;

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
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * @param mixed $famille
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * @param mixed $nourriture
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }

    /**
     * @return mixed
     */
    public function getInsectes()
    {
        return $this->insectes;
    }

    /**
     * @param mixed $insectes
     */
    public function setInsectes($insectes)
    {
        $this->insectes = $insectes;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMyInsectes()
    {
        return $this->myInsectes;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $myInsectes
     */
    public function setMyInsectes($myInsectes)
    {
        $this->myInsectes = $myInsectes;
    }



}
