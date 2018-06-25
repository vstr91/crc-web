<?php

namespace ApiBundle\Entity\Repository;

/**
 * MensagemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MensagemRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('m')
                ->select('m')
                ->distinct()
                ->where("m.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("p.programadoPara IS NULL OR p.programadoPara <= :now")
                //->andWhere("p.ativo = 1")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('m.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
