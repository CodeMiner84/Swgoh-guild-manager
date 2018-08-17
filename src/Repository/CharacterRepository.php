<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CharacterRepository.
 */
class CharacterRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * CharacterRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Character::class);
    }

    /**
     * @param $qb
     * @param string $phrase
     *
     * @return QueryBuilder
     */
    public function findByPhrase($qb, string $phrase): QueryBuilder
    {
        return $qb->andWhere('name', ':phrase')
            ->andWhere('side', ':phrase')
            ->andWhere('tags', ':phrase')
            ->setParameter('phrase', $phrase)
            ;
    }

    public function remove(): void
    {
        $this->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute()
        ;
    }

    /**
     * @param string $code
     * @param array  $data
     */
    public function update(string $code, array $data): void
    {
        $this->createQueryBuilder('c')
            ->update($this->getEntityName(), 'c')
            ->set('c.name', ':name')
            ->set('c.description', ':description')
            ->set('c.side', ':side')
            ->set('c.image', ':image')
            ->set('c.tags', ':tags')
            ->where('c.code = :code')
            ->setParameters([
                'code' => $code,
                'name' => $data['name'],
                'description' => $data['description'],
                'side' => $data['side'],
                'image' => $data['image'],
                'tags' => $data['tags'],
            ])
            ->getQuery()
            ->execute();
    }
}
