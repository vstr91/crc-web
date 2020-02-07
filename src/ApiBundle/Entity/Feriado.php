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
 * Description of Feriado
 *
 * @author Almir
 */

/**
 * Feriado
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\FeriadoRepository")
 * @ORM\Table(name="feriado")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Feriado extends EntidadeSlug {
    
    /**
     * @var string
     *
     * @ORM\Column(name="data", type="datetime")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $data;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cidade")
     * @ORM\JoinColumn(name="cidade", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $cidade;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     * @Gedmo\Versioned
     * 
     */
    private $tipo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rua", type="string", length=500, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $descricao;
    
    public function __toString() {
        return $this->getNome();
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
     * @return Bairro
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
     * @return Bairro
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
     * @return Bairro
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
     * @return Bairro
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
     * @return Bairro
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
     * Set cidade
     *
     * @param \ApiBundle\Entity\Cidade $cidade
     *
     * @return Bairro
     */
    public function setCidade(\ApiBundle\Entity\Cidade $cidade = null)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \ApiBundle\Entity\Cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return Bairro
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
     * @return Bairro
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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Feriado
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Feriado
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Feriado
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }
}
