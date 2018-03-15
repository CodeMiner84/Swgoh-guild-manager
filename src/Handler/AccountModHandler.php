<?php

namespace App\Handler;

use App\Command\UserModCommand;
use App\DBAL\Types\ModStats;
use App\Entity\Account;
use App\Entity\AccountMods;
use App\Entity\Mod;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AccountModHandler.
 */
class AccountModHandler extends ApiHandler
{
    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        /** @var QueryBuilder $qb */
        $qb = $this->qb;
        $userId = $this->user->getId();
        $alias = current($qb->getRootAliases());
        $qb->add('where',
            $qb->expr()->eq($alias.'.account', $userId)
        );

        return $qb;
    }

    /**
     * @param array $params
     * @param array $groups
     */
    public function saveUserMods(array $params, array $groups)
    {
        if ($accountMods = $this->repository->findOneByAccount($this->user->getId())) {
            $accountMods->setMods(json_encode($params));
            $this->em->flush();
        } else {
            $accountMods = new AccountMods();
            $accountMods->setAccount($this->user);
            $accountMods->setMods(json_encode($params));

            $this->em->persist($accountMods);
            $this->em->flush();
        }

        $view = $this->createView(
            $accountMods,
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    public function generate()
    {
        if (!$this->user->getUUid()) {
            throw new \Exception('Unable to fetch user from swgoh.gg');
        }
        $modRepo = $this->em->getRepository(Mod::class);
        $account = $this->em->getRepository(User::class)->findOneBy(['uuid' => $this->user->getUuid()]);

        $mods = $this->generateUserModsTemplate();
        if (!$mods instanceof AccountMods) {
            throw new \Exception('wrong mod');
        }

        $savedMods = json_decode($mods->getMods(), true);

        $return = [];
        $modUuids = [];
        foreach ($savedMods as $key => $savedMod) {
            $primary = $savedMod['primary'];
            $secondary = $savedMod['secondary'];
            $template = [];
            $stats = $savedMod['stats'];
            for ($slot = 1; $slot < 7; $slot++) {
                $template[$slot] = $stats[$slot] ?? null;
            }

            $tmp = [];
            foreach ($template as $slot => $type) {
                $tmp[$slot] = $modRepo->findBestMod($account->getId(), $type, $slot, $modUuids, $primary, $secondary);
                $modUuids[$tmp[$slot]['uuid']] = $tmp[$slot]['uuid'];
            }
            $return[$key] = $tmp;
        }

        return $return;
    }

    private function generateUserModsTemplate()
    {
        return $this->repository->findOneByAccount($this->user->getId());
    }
}
