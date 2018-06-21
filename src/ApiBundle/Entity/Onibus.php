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
 * Description of Onibus
 *
 * @author Almir
 */

/**
 * Onibus
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\OnibusRepository")
 * @ORM\Table(name="onibus")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Onibus extends EntidadeSlug {

    /**
     * @var string
     *
     * @ORM\Column(name="sufixo", type="string", length=10)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $sufixo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="placa", type="string", length=10)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $placa;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ano", type="integer", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $ano;
    
    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $marca;
    
    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $modelo;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $acessivel = false;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $observacao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Empresa")
     * @ORM\JoinColumn(name="empresa", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $empresa;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set sufixo
     *
     * @param string $sufixo
     *
     * @return Onibus
     */
    public function setSufixo($sufixo)
    {
        $this->sufixo = $sufixo;

        return $this;
    }

    /**
     * Get sufixo
     *
     * @return string
     */
    public function getSufixo()
    {
        return $this->sufixo;
    }

    /**
     * Set placa
     *
     * @param string $placa
     *
     * @return Onibus
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;

        return $this;
    }

    /**
     * Get placa
     *
     * @return string
     */
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * Set ano
     *
     * @param integer $ano
     *
     * @return Onibus
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return integer
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set marca
     *
     * @param string $marca
     *
     * @return Onibus
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     *
     * @return Onibus
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set acessivel
     *
     * @param boolean $acessivel
     *
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
     * @return Onibus
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
