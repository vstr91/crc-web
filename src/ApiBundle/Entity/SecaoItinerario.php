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
 * Description of SecaoItinerario
 *
 * @author Almir
 */

/**
 * SecaoItinerario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\SecaoItinerarioRepository")
 * @ORM\Table(name="secao_itinerario")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class SecaoItinerario extends EntidadeBase {
    
    /**
     * @ORM\ManyToOne(targetEntity="Itinerario")
     * @ORM\JoinColumn(name="itinerario", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $itinerario;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100)
     * @Gedmo\Versioned
     * 
     */
    private $nome;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parada")
     * @ORM\JoinColumn(name="paradaInicial", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $paradaInicial;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parada")
     * @ORM\JoinColumn(name="paradaFinal", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $paradaFinal;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tarifa", type="decimal", scale=2, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $tarifa;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return SecaoItinerario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set tarifa
     *
     * @param \double $tarifa
     *
     * @return SecaoItinerario
     */
    public function setTarifa($tarifa)
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
     * @return SecaoItinerario
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
     * @return SecaoItinerario
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
     * @return SecaoItinerario
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
     * @return SecaoItinerario
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
     * @return SecaoItinerario
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
     * Set itinerario
     *
     * @param \ApiBundle\Entity\Itinerario $itinerario
     *
     * @return SecaoItinerario
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
     * Set paradaInicial
     *
     * @param \ApiBundle\Entity\Parada $paradaInicial
     *
     * @return SecaoItinerario
     */
    public function setParadaInicial(\ApiBundle\Entity\Parada $paradaInicial = null)
    {
        $this->paradaInicial = $paradaInicial;

        return $this;
    }

    /**
     * Get paradaInicial
     *
     * @return \ApiBundle\Entity\Parada
     */
    public function getParadaInicial()
    {
        return $this->paradaInicial;
    }

    /**
     * Set paradaFinal
     *
     * @param \ApiBundle\Entity\Parada $paradaFinal
     *
     * @return SecaoItinerario
     */
    public function setParadaFinal(\ApiBundle\Entity\Parada $paradaFinal = null)
    {
        $this->paradaFinal = $paradaFinal;

        return $this;
    }

    /**
     * Get paradaFinal
     *
     * @return \ApiBundle\Entity\Parada
     */
    public function getParadaFinal()
    {
        return $this->paradaFinal;
    }

    /**
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return SecaoItinerario
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
     * @return SecaoItinerario
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
