<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
//use JMS\Serializer\Annotation\ExclusionPolicy;
//use JMS\Serializer\Annotation\Expose;

/**
 * Description of ParadaItinerario
 *
 * @author Almir
 */

/**
 * ParadaItinerario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\ParadaItinerarioRepository")
 * @ORM\Table(name="parada_itinerario")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class ParadaItinerario extends EntidadeBase {
    
    /**
     * @ORM\ManyToOne(targetEntity="Parada")
     * @ORM\JoinColumn(name="parada", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $parada;
    
    /**
     * @ORM\ManyToOne(targetEntity="Itinerario")
     * @ORM\JoinColumn(name="itinerario", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $itinerario;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ordem", type="integer")
     * @Gedmo\Versioned
     * 
     */
    private $ordem;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $destaque = false;
    
    /**
     * @var string
     *
     * @ORM\Column(name="valorAnterior", type="decimal", scale=2, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $valorAnterior;
    
    /**
     * @var string
     *
     * @ORM\Column(name="valorSeguinte", type="decimal", scale=2, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $valorSeguinte;
    
    /**
     * @var string
     *
     * @ORM\Column(name="distanciaSeguinte", type="decimal", scale=2, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $distanciaSeguinte;
    
    /**
     * @ORM\Column(name="tempoSeguinte", type="datetime", nullable=true)
     */
    protected $tempoSeguinte;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set ordem
     *
     * @param integer $ordem
     *
     * @return ParadaItinerario
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;

        return $this;
    }

    /**
     * Get ordem
     *
     * @return integer
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * Set destaque
     *
     * @param boolean $destaque
     *
     * @return ParadaItinerario
     */
    public function setDestaque($destaque)
    {
        $this->destaque = $destaque;

        return $this;
    }

    /**
     * Get destaque
     *
     * @return boolean
     */
    public function getDestaque()
    {
        return $this->destaque;
    }

    /**
     * Set valorAnterior
     *
     * @param \double $valorAnterior
     *
     * @return ParadaItinerario
     */
    public function setValorAnterior($valorAnterior)
    {
        $this->valorAnterior = $valorAnterior;

        return $this;
    }

    /**
     * Get valorAnterior
     *
     * @return \double
     */
    public function getValorAnterior()
    {
        return $this->valorAnterior;
    }

    /**
     * Set valorSeguinte
     *
     * @param \double $valorSeguinte
     *
     * @return ParadaItinerario
     */
    public function setValorSeguinte($valorSeguinte)
    {
        $this->valorSeguinte = $valorSeguinte;

        return $this;
    }

    /**
     * Get valorSeguinte
     *
     * @return \double
     */
    public function getValorSeguinte()
    {
        return $this->valorSeguinte;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ativo
     *
     * @param boolean $ativo
     *
     * @return ParadaItinerario
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo
     *
     * @return boolean
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return ParadaItinerario
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set dataRecebimento
     *
     * @param \DateTime $dataRecebimento
     *
     * @return ParadaItinerario
     */
    public function setDataRecebimento($dataRecebimento)
    {
        $this->dataRecebimento = $dataRecebimento;

        return $this;
    }

    /**
     * Get dataRecebimento
     *
     * @return \DateTime
     */
    public function getDataRecebimento()
    {
        return $this->dataRecebimento;
    }

    /**
     * Set ultimaAlteracao
     *
     * @param \DateTime $ultimaAlteracao
     *
     * @return ParadaItinerario
     */
    public function setUltimaAlteracao($ultimaAlteracao)
    {
        $this->ultimaAlteracao = $ultimaAlteracao;

        return $this;
    }

    /**
     * Get ultimaAlteracao
     *
     * @return \DateTime
     */
    public function getUltimaAlteracao()
    {
        return $this->ultimaAlteracao;
    }

    /**
     * Set programadoPara
     *
     * @param \DateTime $programadoPara
     *
     * @return ParadaItinerario
     */
    public function setProgramadoPara($programadoPara)
    {
        $this->programadoPara = $programadoPara;

        return $this;
    }

    /**
     * Get programadoPara
     *
     * @return \DateTime
     */
    public function getProgramadoPara()
    {
        return $this->programadoPara;
    }

    /**
     * Set parada
     *
     * @param \ApiBundle\Entity\Parada $parada
     *
     * @return ParadaItinerario
     */
    public function setParada(\ApiBundle\Entity\Parada $parada = null)
    {
        $this->parada = $parada;

        return $this;
    }

    /**
     * Get parada
     *
     * @return \ApiBundle\Entity\Parada
     */
    public function getParada()
    {
        return $this->parada;
    }

    /**
     * Set itinerario
     *
     * @param \ApiBundle\Entity\Itinerario $itinerario
     *
     * @return ParadaItinerario
     */
    public function setItinerario(\ApiBundle\Entity\Itinerario $itinerario = null)
    {
        $this->itinerario = $itinerario;

        return $this;
    }

    /**
     * Get itinerario
     *
     * @return \ApiBundle\Entity\Itinerario
     */
    public function getItinerario()
    {
        return $this->itinerario;
    }

    /**
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return ParadaItinerario
     */
    public function setUsuarioCadastro(\ApiBundle\Entity\Usuario $usuarioCadastro = null)
    {
        $this->usuarioCadastro = $usuarioCadastro;

        return $this;
    }

    /**
     * Get usuarioCadastro
     *
     * @return \ApiBundle\Entity\Usuario
     */
    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    /**
     * Set usuarioUltimaAlteracao
     *
     * @param \ApiBundle\Entity\Usuario $usuarioUltimaAlteracao
     *
     * @return ParadaItinerario
     */
    public function setUsuarioUltimaAlteracao(\ApiBundle\Entity\Usuario $usuarioUltimaAlteracao = null)
    {
        $this->usuarioUltimaAlteracao = $usuarioUltimaAlteracao;

        return $this;
    }

    /**
     * Get usuarioUltimaAlteracao
     *
     * @return \ApiBundle\Entity\Usuario
     */
    public function getUsuarioUltimaAlteracao()
    {
        return $this->usuarioUltimaAlteracao;
    }

    /**
     * Set distanciaSeguinte
     *
     * @param string $distanciaSeguinte
     *
     * @return ParadaItinerario
     */
    public function setDistanciaSeguinte($distanciaSeguinte)
    {
        $this->distanciaSeguinte = $distanciaSeguinte;

        return $this;
    }

    /**
     * Get distanciaSeguinte
     *
     * @return string
     */
    public function getDistanciaSeguinte()
    {
        return $this->distanciaSeguinte;
    }

    /**
     * Set tempoSeguinte
     *
     * @param \DateTime $tempoSeguinte
     *
     * @return ParadaItinerario
     */
    public function setTempoSeguinte($tempoSeguinte)
    {
        $this->tempoSeguinte = $tempoSeguinte;

        return $this;
    }

    /**
     * Get tempoSeguinte
     *
     * @return \DateTime
     */
    public function getTempoSeguinte()
    {
        return $this->tempoSeguinte;
    }
}
