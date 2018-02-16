<?php

namespace App\Entity;

/**
 * Trait RequestTrait.
 */
trait RequestTrait
{
    /**
     * @param EntityInterface $entity
     * @param array           $params
     *
     * @return EntityInterface
     */
    public function patchAction(EntityInterface $entity, array $params)
    {
        foreach ($params as $param => $value) {
            $setter = sprintf('set%s', ucfirst($param));
            if (in_array($param, self::ALLOWED_PARAMS, true)) {
                $entity->$setter($value);
            }
        }
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }
}
