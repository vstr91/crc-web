<?php

namespace ApiBundle\Entity\Repository;

/**
 * ParadaItinerarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParadaItinerarioRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('pi')
                ->select('pi.id, pi.ativo, pi.dataCadastro, pi.dataRecebimento, '
                        . 'pi.ultimaAlteracao, pi.programadoPara, IDENTITY(pi.usuarioCadastro) AS usuarioCadastro, '
                        . 'IDENTITY(pi.usuarioUltimaAlteracao) AS usuarioUltimaAlteracao, pi.ordem, pi.destaque, pi.valorAnterior, '
                        . 'pi.valorSeguinte, IDENTITY(pi.parada) AS parada, IDENTITY(pi.itinerario) AS itinerario')
                ->distinct()
                ->where("pi.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("c.programadoPara IS NULL OR c.programadoPara <= :now")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('pi.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
