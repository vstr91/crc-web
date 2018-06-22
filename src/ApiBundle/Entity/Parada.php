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
 * Description of Parada
 *
 * @author Almir
 */

/**
 * Parada
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\ParadaRepository")
 * @ORM\Table(name="parada")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Parada extends EntidadeSlug {

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $longitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="taxaDeEmbarque", type="decimal", nullable=true)
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
    
    public function __toString() {
        return $this->getNome();
    }


    /**
     * Set latitude
     *
     * @param \double $latitude
     *
     * @return Parada
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
     * @return Parada
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
     * Set taxaDeEmbarque
     *
     * @param \double $taxaDeEmbarque
     *
     * @return Parada
     */
    public function setTaxaDeEmbarque($taxaDeEmbarque)
    {
        $this->taxaDeEmbarque = $taxaDeEmbarque;

        return $this;
    }

    /**
     * Get taxaDeEmbarque
     *
     * @return \double
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
     * @return Parada
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
