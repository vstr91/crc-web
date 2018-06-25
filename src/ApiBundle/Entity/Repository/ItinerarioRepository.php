<?php

namespace ApiBundle\Entity\Repository;

/**
 * ItinerarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ItinerarioRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('i')
                ->select('i.id, i.ativo, i.dataCadastro AS data_cadastro, i.dataRecebimento AS data_recebimento, '
                        . 'i.ultimaAlteracao AS ultima_alteracao, i.programadoPara AS programado_para, IDENTITY(i.usuarioCadastro) AS usuario_cadastro, '
                        . 'IDENTITY(i.usuarioUltimaAlteracao) AS usuario_ultima_alteracao, i.tarifa, i.sigla, i.distancia, i.tempo, i.acessivel, '
                        . 'i.observacao, IDENTITY(i.empresa) AS empresa')
                ->distinct()
                ->where("i.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("c.programadoPara IS NULL OR c.programadoPara <= :now")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('i.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
