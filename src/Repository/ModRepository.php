<?php

namespace App\Repository;

use App\DBAL\Types\ModPrimary;
use App\DBAL\Types\ModSecondary;
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

    public function findBestMod(int $accountId, ?array $params, ?string $slot, array $existed = [], ?string $globalPrimary, ?string $globalSecondary)
    {
        $mod = $params['mod'];
        $primary = $params['primary'];
        $secondary = $params['secondary'];

        $qb = $this->createQueryBuilder('m')
        ;

        if (!$primary && $globalPrimary) {
            $primary = $globalPrimary;
        }

        if (!$secondary && $globalSecondary) {
            $secondary = $globalSecondary;
        }

        $query = $qb
            ->select('partial m.{id, image, uuid}', 'partial character.{id, name, image}', 'IDENTITY(types.mod) as mod_id')
            ->addSelect('ABS(types.value) AS HIDDEN val')
            ->innerJoin('m.types', 'types')
            ->innerJoin('m.character', 'character')
            ->where('m.user = :account')
            ->setParameter('account', $accountId)
        ;

        if ($mod) {
            $query->andWhere('m.type = :type')
                ->setParameter('type', $mod);
        }
        if ($slot) {
            $query->andWhere('m.slot = :slot')
                ->setParameter('slot', $slot);
        }

        if ($primary && $primary !== 'select') {
            $query->andWhere($qb->expr()->andX(
                $qb->expr()->eq('types.name', ':primary'),
                $qb->expr()->eq('types.kind', '0')
            ))
                ->setParameter('primary', ModPrimary::STATS[$primary]);
        }

        if ($secondary && $secondary !== 'select') {
            $query->andWhere($qb->expr()->andX(
                $qb->expr()->eq('types.name', ':secondary'),
                $qb->expr()->eq('types.kind', '1')
            ))
                ->setParameter('secondary', ModSecondary::STATS[$secondary]);
        }

        if (count($existed) > 0) {
            $qb->andWhere($qb->expr()->notIn('m.uuid', $existed));
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
