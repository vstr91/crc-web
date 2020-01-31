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
 * Description of ViagemItinerario
 *
 * @author Almir
 */

/**
 * HistoricoItinerario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\ViagemItinerarioRepository")
 * @ORM\Table(name="viagem_itinerario")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class ViagemItinerario extends EntidadeBase {
    
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
     * @ORM\Column(name="trajeto", type="string")
     * @Gedmo\Versioned
     * 
     */
    private $trajeto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="horaInicial", type="datetime")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $horaInicial;
    
    /**
     * @var string
     *
     * @ORM\Column(name="horaFinal", type="datetime")
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $horaFinal;
   

    /**
     * Set trajeto
     *
     * @param string $trajeto
     *
     * @return ViagemItinerario
     */
    public function setTrajeto($trajeto)
    {
        $this->trajeto = $trajeto;

        return $this;
    }

    /**
     * Get trajeto
     *
     * @return string
     */
    public function getTrajeto()
    {
        return $this->trajeto;
    }

    /**
     * Set horaInicial
     *
     * @param \DateTime $horaInicial
     *
     * @return ViagemItinerario
     */
    public function setHoraInicial($horaInicial)
    {
        $this->horaInicial = $horaInicial;

        return $this;
    }

    /**
     * Get horaInicial
     *
     * @return \DateTime
     */
    public function getHoraInicial()
    {
        return $this->horaInicial;
    }

    /**
     * Set horaFinal
     *
     * @param \DateTime $horaFinal
     *
     * @return ViagemItinerario
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return \DateTime
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
     * @return ViagemItinerario
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
