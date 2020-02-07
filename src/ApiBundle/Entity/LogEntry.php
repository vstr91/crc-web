<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ApiBundle\Entity\Repository\LogEntryRepository")
 */
class LogEntry extends \Gedmo\Loggable\Entity\LogEntry
{
    /**
     * All required columns are mapped through inherited superclass
     */
}
