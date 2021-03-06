<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contacts")
 */
class Contacts {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $phones;

    /**
     * @ORM\Column(type="text")
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $skype;

    /**
     * @ORM\Column(type="text")
     */
    private $mapCode;

    /**
     * @ORM\Column(type="string")
     */
    private $mapX;

    /**
     * @ORM\Column(type="string")
     */
    private $mapY;

    /**
     * @ORM\Column(type="string")
     */
    private $mapPointHint;

    /**
     * @ORM\Column(type="text")
     */
    private $mapPointInformation;

    /**
     * @ORM\Column(type="text")
     */
    private $registrationData;

    /**
     * @ORM\Column(type="text")
     */
    private $junctionSchema;

    /**
     * @ORM\Column(type="text")
     */
    private $essential;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    public function __toString()
    {
        return 'Контакты';
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
     * Set phones
     *
     * @param string $phones
     * @return Contacts
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * Get phones
     *
     * @return string 
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contacts
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
     * Set skype
     *
     * @param string $skype
     * @return Contacts
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string 
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set mapCode
     *
     * @param string $mapCode
     * @return Contacts
     */
    public function setMapCode($mapCode)
    {
        $this->mapCode = $mapCode;

        return $this;
    }

    /**
     * Get mapCode
     *
     * @return string 
     */
    public function getMapCode()
    {
        return $this->mapCode;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return Contacts
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set mapX
     *
     * @param string $mapX
     * @return Contacts
     */
    public function setMapX($mapX)
    {
        $this->mapX = $mapX;

        return $this;
    }

    /**
     * Get mapX
     *
     * @return string 
     */
    public function getMapX()
    {
        return $this->mapX;
    }

    /**
     * Set mapY
     *
     * @param string $mapY
     * @return Contacts
     */
    public function setMapY($mapY)
    {
        $this->mapY = $mapY;

        return $this;
    }

    /**
     * Get mapY
     *
     * @return string 
     */
    public function getMapY()
    {
        return $this->mapY;
    }

    /**
     * Set mapPointInformation
     *
     * @param string $mapPointInformation
     * @return Contacts
     */
    public function setMapPointInformation($mapPointInformation)
    {
        $this->mapPointInformation = $mapPointInformation;

        return $this;
    }

    /**
     * Get mapPointInformation
     *
     * @return string 
     */
    public function getMapPointInformation()
    {
        return $this->mapPointInformation;
    }

    /**
     * Set registrationData
     *
     * @param string $registrationData
     * @return Contacts
     */
    public function setRegistrationData($registrationData)
    {
        $this->registrationData = $registrationData;

        return $this;
    }

    /**
     * Get registrationData
     *
     * @return string 
     */
    public function getRegistrationData()
    {
        return $this->registrationData;
    }

    /**
     * Set mapPointHint
     *
     * @param string $mapPointHint
     * @return Contacts
     */
    public function setMapPointHint($mapPointHint)
    {
        $this->mapPointHint = $mapPointHint;

        return $this;
    }

    /**
     * Get mapPointHint
     *
     * @return string 
     */
    public function getMapPointHint()
    {
        return $this->mapPointHint;
    }

    /**
     * Set junctionSchema
     *
     * @param string $junctionSchema
     * @return Contacts
     */
    public function setJunctionSchema($junctionSchema)
    {
        $this->junctionSchema = $junctionSchema;

        return $this;
    }

    /**
     * Get junctionSchema
     *
     * @return string 
     */
    public function getJunctionSchema()
    {
        return $this->junctionSchema;
    }

    /**
     * Set essential
     *
     * @param string $essential
     * @return Contacts
     */
    public function setEssential($essential)
    {
        $this->essential = $essential;

        return $this;
    }

    /**
     * Get essential
     *
     * @return string 
     */
    public function getEssential()
    {
        return $this->essential;
    }
}
