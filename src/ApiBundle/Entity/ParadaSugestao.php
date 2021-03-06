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
 * Description of ParadaSugestao
 *
 * @author Almir
 */

/**
 * Parada
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\ParadaSugestaoRepository")
 * @ORM\Table(name="parada_sugestao")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class ParadaSugestao extends EntidadeSlug {
    
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
     * @ORM\Column(name="taxaDeEmbarque", type="decimal", scale=2, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $taxaDeEmbarque;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagem", type="string", length=100, nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $imagem;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bairro")
     * @ORM\JoinColumn(name="bairro", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $bairro;
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="text", nullable=true)
     * @Gedmo\Versioned
     * 
     */
    private $observacao;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parada")
     * @ORM\JoinColumn(name="parada", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $parada;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     * @Gedmo\Versioned
     * 
     */
    private $status;
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return ParadaSugestao
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
     * Set parada
     *
     * @param \ApiBundle\Entity\Parada $parada
     *
     * @return ParadaSugestao
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
     * Set latitude
     *
     * @param string $latitude
     *
     * @return ParadaSugestao
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return ParadaSugestao
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set taxaDeEmbarque
     *
     * @param string $taxaDeEmbarque
     *
     * @return ParadaSugestao
     */
    public function setTaxaDeEmbarque($taxaDeEmbarque)
    {
        $this->taxaDeEmbarque = $taxaDeEmbarque;

        return $this;
    }

    /**
     * Get taxaDeEmbarque
     *
     * @return string
     */
    public function getTaxaDeEmbarque()
    {
        return $this->taxaDeEmbarque;
    }

    /**
     * Set imagem
     *
     * @param string $imagem
     *
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * Set bairro
     *
     * @param \ApiBundle\Entity\Bairro $bairro
     *
     * @return ParadaSugestao
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

    /**
     * Set usuarioCadastro
     *
     * @param \ApiBundle\Entity\Usuario $usuarioCadastro
     *
     * @return ParadaSugestao
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
     * @return ParadaSugestao
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
     * Set status
     *
     * @param integer $status
     *
     * @return ParadaSugestao
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
