<?php

namespace FTC\Bundle\CodeBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * VoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VoteRepository extends EntityRepository
{

    /**
     * Retrieves existing vote for this comment by this user
     *
     * @param Comment $comment
     * @param \FTC\Bundle\AuthBundle\Entity\User $user
     * @return Vote|null
     */
    public function getExistingVote($comment, $user)
    {
        try {

            $qb = $this->createQueryBuilder('v');

            $qb->andWhere('v.comment = ?0');
            $qb->andWhere('v.user = ?1');

            $qb->setParameters(array($comment, $user));

            return $qb->getQuery()->getSingleResult();

        } catch (NonUniqueResultException $e) {
            return null;
        } catch (NoResultException $e) {
            return null;
        }

    }

}