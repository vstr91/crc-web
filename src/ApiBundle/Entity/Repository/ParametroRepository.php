<?php

namespace ApiBundle\Entity\Repository;

/**
 * ParametroRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParametroRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('p')
                ->select('p')
                ->distinct()
                ->where("p.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("p.programadoPara IS NULL OR p.programadoPara <= :now")
                //->andWhere("p.ativo = 1")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('p.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
