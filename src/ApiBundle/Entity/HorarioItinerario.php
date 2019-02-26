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
 * Description of HorarioItinerario
 *
 * @author Almir
 */

/**
 * HorarioItinerario
 *
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\HorarioItinerarioRepository")
 * @ORM\Table(name="horario_itinerario")
 * @Gedmo\Loggable
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class HorarioItinerario extends EntidadeBase {
    
    /**
     * @ORM\ManyToOne(targetEntity="Horario")
     * @ORM\JoinColumn(name="horario", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $horario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Itinerario")
     * @ORM\JoinColumn(name="itinerario", referencedColumnName="id")
     * @Gedmo\Versioned
     * 
     */
    protected $itinerario;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $domingo = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $segunda = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $terca = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $quarta = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $quinta = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $sexta = false;
    
    /**
     * @ORM\Column(type="boolean")
     * @Gedmo\Versioned
     * 
     */
    protected $sabado = false;
    
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
     * Set domingo
     *
     * @param boolean $domingo
     *
     * @return HorarioItinerario
     */
    public function setDomingo($domingo)
    {
        $this->domingo = $domingo;

        return $this;
    }

    /**
     * Get domingo
     *
     * @return boolean
     */
    public function getDomingo()
    {
        return $this->domingo;
    }

    /**
     * Set segunda
     *
     * @param boolean $segunda
     *
     * @return HorarioItinerario
     */
    public function setSegunda($segunda)
    {
        $this->segunda = $segunda;

        return $this;
    }

    /**
     * Get segunda
     *
     * @return boolean
     */
    public function getSegunda()
    {
        return $this->segunda;
    }

    /**
     * Set terca
     *
     * @param boolean $terca
     *
     * @return HorarioItinerario
     */
    public function setTerca($terca)
    {
        $this->terca = $terca;

        return $this;
    }

    /**
     * Get terca
     *
     * @return boolean
     */
    public function getTerca()
    {
        return $this->terca;
    }

    /**
     * Set quarta
     *
     * @param boolean $quarta
     *
     * @return HorarioItinerario
     */
    public function setQuarta($quarta)
    {
        $this->quarta = $quarta;

        return $this;
    }

    /**
     * Get quarta
     *
     * @return boolean
     */
    public function getQuarta()
    {
        return $this->quarta;
    }

    /**
     * Set quinta
     *
     * @param boolean $quinta
     *
     * @return HorarioItinerario
     */
    public function setQuinta($quinta)
    {
        $this->quinta = $quinta;

        return $this;
    }

    /**
     * Get quinta
     *
     * @return boolean
     */
    public function getQuinta()
    {
        return $this->quinta;
    }

    /**
     * Set sexta
     *
     * @param boolean $sexta
     *
     * @return HorarioItinerario
     */
    public function setSexta($sexta)
    {
        $this->sexta = $sexta;

        return $this;
    }

    /**
     * Get sexta
     *
     * @return boolean
     */
    public function getSexta()
    {
        return $this->sexta;
    }

    /**
     * Set sabado
     *
     * @param boolean $sabado
     *
     * @return HorarioItinerario
     */
    public function setSabado($sabado)
    {
        $this->sabado = $sabado;

        return $this;
    }

    /**
     * Get sabado
     *
     * @return boolean
     */
    public function getSabado()
    {
        return $this->sabado;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * Set horario
     *
     * @param \ApiBundle\Entity\Horario $horario
     *
     * @return HorarioItinerario
     */
    public function setHorario(\ApiBundle\Entity\Horario $horario = null)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return \ApiBundle\Entity\Horario
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set itinerario
     *
     * @param \ApiBundle\Entity\Itinerario $itinerario
     *
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
     * @return HorarioItinerario
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
