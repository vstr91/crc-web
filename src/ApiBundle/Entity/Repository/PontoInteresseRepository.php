<?php

namespace ApiBundle\Entity\Repository;

/**
 * PontoInteresseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PontoInteresseRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodosRESTAdmin($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('p')
                ->select('p.id, p.ativo, p.dataCadastro, p.dataRecebimento, '
                        . 'p.ultimaAlteracao, p.programadoPara, IDENTITY(p.usuarioCadastro) AS usuarioCadastro, '
                        . 'IDENTITY(p.usuarioUltimaAlteracao) AS usuarioUltimaAlteracao, p.nome, p.descricao, '
                        . 'p.slug, p.imagem, '
                        . 'p.latitude, p.longitude, p.dataInicial, p.dataFinal, p.permanente, IDENTITY(p.bairro) AS bairro')
                ->distinct()
                ->where("p.ultimaAlteracao > :ultimaAlteracao")
                //->andWhere("c.programadoPara IS NULL OR c.programadoPara <= :now")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->addOrderBy('p.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
    public function listarTodosREST($limite = null, $dataUltimoAcesso){
        $qb = $this->createQueryBuilder('p')
                ->select('p.id, p.ativo, p.dataCadastro, p.dataRecebimento, '
                        . 'p.ultimaAlteracao, p.programadoPara, IDENTITY(p.usuarioCadastro) AS usuarioCadastro, '
                        . 'IDENTITY(p.usuarioUltimaAlteracao) AS usuarioUltimaAlteracao, p.nome, p.descricao, '
                        . 'p.slug, p.imagem, '
                        . 'p.latitude, p.longitude, p.dataInicial, p.dataFinal, p.permanente, IDENTITY(p.bairro) AS bairro')
                ->distinct()
                ->where("p.ultimaAlteracao > :ultimaAlteracao")
                ->andWhere("p.programadoPara IS NULL OR p.programadoPara <= :now")
                ->setParameter('ultimaAlteracao', $dataUltimoAcesso)
                ->setParameter('now', new \DateTime())
                ->addOrderBy('p.id');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
