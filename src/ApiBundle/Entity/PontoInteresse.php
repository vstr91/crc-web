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
 * Description of PontoInteresse
 *
 * @author Almir
 */

/**
 * PontoInteresse
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\PontoInteresseRepository")
 * @ORM\Table(name="ponto_interesse")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class PontoInteresse extends EntidadeSlug {

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $descricao;
    
    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=50)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=50)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $longitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagem", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $imagem;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dataInicial", type="datetime")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $dataInicial;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dataFinal", type="datetime", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $dataFinal;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bairro")
     * @ORM\JoinColumn(name="bairro", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $bairro;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $permanente = true;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set latitude
     *
     * @param \double $latitude
     *
     * @return PontoInteresse
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return \double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param \double $longitude
     *
     * @return PontoInteresse
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return \double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set imagem
     *
     * @param string $imagem
     *
     * @return PontoInteresse
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem
     *
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set dataInicial
     *
     * @param \DateTime $dataInicial
     *
     * @return PontoInteresse
     */
    public function setDataInicial($dataInicial)
    {
        $this->dataInicial = $dataInicial;

        return $this;
    }

    /**
     * Get dataInicial
     *
     * @return \DateTime
     */
    public function getDataInicial()
    {
        return $this->dataInicial;
    }

    /**
     * Set dataFinal
     *
     * @param \DateTime $dataFinal
     *
     * @return PontoInteresse
     */
    public function setDataFinal($dataFinal)
    {
        $this->dataFinal = $dataFinal;

        return $this;
    }

    /**
     * Get dataFinal
     *
     * @return \DateTime
     */
    public function getDataFinal()
    {
        return $this->dataFinal;
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * @return PontoInteresse
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return PontoInteresse
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
     * Set permanente
     *
     * @param boolean $permanente
     *
     * @return PontoInteresse
     */
    public function setPermanente($permanente)
    {
        $this->permanente = $permanente;

        return $this;
    }

    /**
     * Get permanente
     *
     * @return boolean
     */
    public function getPermanente()
    {
        return $this->permanente;
    }

    /**
     * Set bairro
     *
     * @param \ApiBundle\Entity\Bairro $bairro
     *
     * @return PontoInteresse
     */
    public function setBairro(\ApiBundle\Entity\Bairro $bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return \ApiBundle\Entity\Bairro
     */
    public function getBairro()
    {
        return $this->bairro;
    }
}
