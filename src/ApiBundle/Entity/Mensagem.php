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
 * Description of Mensagem
 *
 * @author Almir
 */

/**
 * Mensagem
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\MensagemRepository")
 * @ORM\Table(name="mensagem")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Mensagem extends EntidadeBase {

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $titulo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="resumo", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $resumo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $descricao;
    
    /**
     * @ORM\Column(type="boolean")
     * 
     */
    protected $servidor;
    
    public function __toString() {
        return $this->getId();
    }


    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Mensagem
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set resumo
     *
     * @param string $resumo
     *
     * @return Mensagem
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;

        return $this;
    }

    /**
     * Get resumo
     *
     * @return string
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Mensagem
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
     * @return Mensagem
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
     * @return Mensagem
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
     * @return Mensagem
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
     * @return Mensagem
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
     * @return Mensagem
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
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return Mensagem
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
     * @return Mensagem
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
    
    function getServidor() {
        return $this->servidor;
    }

    function setServidor($servidor) {
        $this->servidor = $servidor;
    }
    

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Mensagem
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
}
