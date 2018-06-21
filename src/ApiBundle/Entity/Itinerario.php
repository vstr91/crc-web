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
 * Description of Itinerario
 *
 * @author Almir
 */

/**
 * Itinerario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\ItinerarioRepository")
 * @ORM\Table(name="itinerario")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Itinerario extends EntidadeBase {

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=5, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $sigla;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tarifa", type="decimal")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $tarifa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="distancia", type="decimal", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $distancia;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $tempo;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $acessivel = false;
    
    /**
     * @ORM\ManyToOne(targetEntity="Empresa")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $empresa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $observacao;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return Itinerario
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set tarifa
     *
     * @param \double $tarifa
     *
     * @return Itinerario
     */
    public function setTarifa(\double $tarifa)
    {
        $this->tarifa = $tarifa;

        return $this;
    }

    /**
     * Get tarifa
     *
     * @return \double
     */
    public function getTarifa()
    {
        return $this->tarifa;
    }

    /**
     * Set distancia
     *
     * @param \double $distancia
     *
     * @return Itinerario
     */
    public function setDistancia(\double $distancia)
    {
        $this->distancia = $distancia;

        return $this;
    }

    /**
     * Get distancia
     *
     * @return \double
     */
    public function getDistancia()
    {
        return $this->distancia;
    }

    /**
     * Set tempo
     *
     * @param \DateTime $tempo
     *
     * @return Itinerario
     */
    public function setTempo($tempo)
    {
        $this->tempo = $tempo;

        return $this;
    }

    /**
     * Get tempo
     *
     * @return \DateTime
     */
    public function getTempo()
    {
        return $this->tempo;
    }

    /**
     * Set acessivel
     *
     * @param boolean $acessivel
     *
     * @return Itinerario
     */
    public function setAcessivel($acessivel)
    {
        $this->acessivel = $acessivel;

        return $this;
    }

    /**
     * Get acessivel
     *
     * @return boolean
     */
    public function getAcessivel()
    {
        return $this->acessivel;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Itinerario
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
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
     * @return Itinerario
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
     * @return Itinerario
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
     * @return Itinerario
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
     * @return Itinerario
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
     * @return Itinerario
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
     * Set empresa
     *
     * @param \ApiBundle\Entity\Empresa $empresa
     *
     * @return Itinerario
     */
    public function setEmpresa(\ApiBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \ApiBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return Itinerario
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
     * @return Itinerario
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
}
