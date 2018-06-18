<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Description of Usuario
 *
 * @author Almir
 */

/**
 * Usuario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Usuario extends BaseUser {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    private $facebookID;
 
    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    private $googleID;
    
    /**
     * @var string
     *
     * @ORM\Column(name="google_access_token", type="string", nullable=true)
     */
    private $googleAccessToken;
    

    /**
     * Set facebookID
     *
     * @param string $facebookID
     *
     * @return Usuario
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;

        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }

    /**
     * Set googleID
     *
     * @param string $googleID
     *
     * @return Usuario
     */
    public function setGoogleID($googleID)
    {
        $this->googleID = $googleID;

        return $this;
    }

    /**
     * Get googleID
     *
     * @return string
     */
    public function getGoogleID()
    {
        return $this->googleID;
    }
    
    function getGoogleAccessToken() {
        return $this->googleAccessToken;
    }

    function setGoogleAccessToken($googleAccessToken) {
        $this->googleAccessToken = $googleAccessToken;
    }

    
}