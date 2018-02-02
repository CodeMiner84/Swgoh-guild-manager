<?php

namespace App\Repository;

use App\Entity\Setting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class SettingRepository.
 */
class SettingRepository extends ServiceEntityRepository
{
    /**
     * SettingRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Setting::class);
    }

    /**
     * @param string $code
     *
     * @return mixed
     */
    public function getOneByCode(string $code)
    {
        return $this->createQueryBuilder('s')
            ->where('s.code = :code')->setParameter('code', $code)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
