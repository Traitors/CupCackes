<?php

/**
 * Created by PhpStorm.
 * User: émine
 * Date: 08/04/2017
 * Time: 18:16
 */

use Doctrine\ORM\EntityRepository;

class ReclamationRechercheRepository extends EntityRepository
{
    public function search($search){


        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from('ReclamationBundle:Reclamation', 'u')
            ->where('u.sujetreclamation = :id1')
            ->setParameter('id1', $search);

        return $qb->getQuery()->getResult();

    }

}