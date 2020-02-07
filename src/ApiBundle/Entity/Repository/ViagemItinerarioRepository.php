<?php

namespace ApiBundle\Entity\Repository;

/**
 * ViagemItinerarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ViagemItinerarioRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosREST($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('v')
                ->select('v.id, v.ativo, v.dataCadastro, v.dataRecebimento, '
                        . 'v.ultimaAlteracao, v.programadoPara, IDENTITY(v.usuarioCadastro) AS usuarioCadastro, '
                        . 'IDENTITY(v.usuarioUltimaAlteracao) AS usuarioUltimaAlteracao, IDENTITY(v.itinerario) AS itinerario, '
                        . 'v.trajeto, v.horaInicial, v.horaFinal')
                ->distinct()
                ->where("v.ultimaAlteracao > :ultimaAlteracao")
                ->andWhere("v.programadoPara IS NULL OR v.programadoPara <= :now")
                ->andWhere("v.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("p.ativo = 1")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->setParameter('now', new \DateTime())
                ->addOrderBy('v.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('v')
                ->select('v.id, v.ativo, v.dataCadastro, v.dataRecebimento, '
                        . 'v.ultimaAlteracao, v.programadoPara, IDENTITY(v.usuarioCadastro) AS usuarioCadastro, '
                        . 'IDENTITY(v.usuarioUltimaAlteracao) AS usuarioUltimaAlteracao, IDENTITY(v.itinerario) AS itinerario, '
                        . 'v.trajeto, v.horaInicial, v.horaFinal')
                ->distinct()
                ->where("v.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("p.programadoPara IS NULL OR p.programadoPara <= :now")
                //->andWhere("p.ativo = 1")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('v.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}