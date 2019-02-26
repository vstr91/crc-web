<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Description of EntidadeBase
 *
 * @author Almir
 */
/** @ORM\MappedSuperclass */
abstract class EntidadeBase {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * 
     */
    protected $id;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $ativo = true;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataCadastro;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $dataRecebimento;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $ultimaAlteracao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuarioCadastro", referencedColumnName="id")
     * @Gedmo\Blameable(on="create")
     * 
     */
    protected $usuarioCadastro;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuarioUltimaAlteracao", referencedColumnName="id")
     * @Gedmo\Blameable(on="update")
     * 
     */
    protected $usuarioUltimaAlteracao;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $programadoPara;
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setDataRecebimento(new \DateTime());
        $this->setUltimaAlteracao(new \DateTime());
        
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUltimaAlteracao(new \DateTime());
    }
    
    /**
     * Set id
     *
     * @param string $id
     *
     * @return Pais
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
}
