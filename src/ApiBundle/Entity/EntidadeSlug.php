<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ApiBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Description of EntidadeSlug
 *
 * @author Almir
 */
/** @ORM\MappedSuperclass */
abstract class EntidadeSlug extends EntidadeBase {
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     * 
     */
    private $nome;
    
    /**
     * @Gedmo\Slug(fields={"nome"})
     * @ORM\Column(unique=false)
     */
    private $slug;
    
    function getNome() {
        return $this->nome;
    }

    function getSlug() {
        return $this->slug;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSlug($slug) {
        $this->slug = $slug;
    }
    
}
