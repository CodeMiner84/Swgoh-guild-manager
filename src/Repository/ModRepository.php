<?php

namespace App\Repository;

use App\DBAL\Types\ModStats;
use App\Entity\Mod;
use App\Entity\ModType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ModRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mod::class);
    }

    public function remove(): void
    {
        $this->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute()
        ;
    }

    public function findBestMod(int $accountId, ?string $type, ?string $slot, ?string $primary, ?string $secondary)
    {
        $qb = $this->createQueryBuilder('m')
        ;

        $query = $qb
            ->select('partial m.{id,image}', 'partial character.{id, name, image}', 'IDENTITY(types.mod) as mod_id')
            ->addSelect('ABS(types.value) AS HIDDEN val')
            ->innerJoin('m.types', 'types')
            ->innerJoin('m.character', 'character')
            ->where('m.user = :account')
            ->setParameter('account', $accountId)
        ;


        if ($type) {
            $query->andWhere('m.type = :type')
                ->setParameter('type', $type);
        }
        if ($slot) {
            $query->andWhere('m.slot = :slot')
                ->setParameter('slot', $slot);
        }

        if ($secondary) {
            $query->andWhere($qb->expr()->andX(
                $qb->expr()->eq('types.name', ':secondary'),
                $qb->expr()->eq('types.kind', '1')
                ))
                ->setParameter('secondary', ModStats::MOD_STATS[$secondary]);
        }

        $query->setMaxResults(1);
        $query->orderBy('val', 'DESC');


        $result = $query->getQuery()->getArrayResult();

        if (!$result) {
            return null;
        }
        ini_set('xdebug.var_display_max_depth', 6);

        $_res = $result[0][0];
        foreach ($result as $key => $res) {
            $modId = $res['mod_id'];
            $values = $this->getEntityManager()->getRepository(ModType::class)->createQueryBuilder('m')
                ->where('m.mod = :mod')
                ->setParameter('mod', $modId)
                ->orderBy('m.kind', 'ASC')
                ->getQuery()
                ->getArrayResult()
            ;
            $_res['stats'] = $values;
        }

        return $_res;
    }
}
