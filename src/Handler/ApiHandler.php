<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ApiHandler.
 */
class ApiHandler
{
    private const MAX_RESULTS = 100;

    /**
     * @var ViewHandlerInterface
     */
    public $viewhandler;

    /**
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    public $repository;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var QueryBuilder
     */
    public $qb;

    /**
     * ApiHandler constructor.
     *
     * @param RequestStack           $requestStack
     * @param EntityManagerInterface $em
     * @param ViewHandlerInterface   $viewHandler
     */
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em, ViewHandlerInterface $viewHandler)
    {
        $this->viewhandler = $viewHandler;
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param string $entity
     *
     * @return $this
     */
    public function init(string $entity)
    {
        $this->qb = $this->em->getRepository($entity)->createQueryBuilder('c');
        $this->repository = $this->em->getRepository($entity);

        return $this;
    }

    /**
     * @param $id
     * @param $groups
     *
     * @return mixed
     */
    public function getResource($id, $groups)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @param array $groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function collect(array $groups, string $id = null)
    {
        $view = $this->createView(
            $id ?
                $this->getResource($id, $groups) :
                $this->transformIterator($this->getPaginatedResult()),
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    /**
     * @param $data
     * @param array $groups
     *
     * @return View
     */
    public function createView($data, array $groups): View
    {
        $view = View::create($data);

        if (count($groups) > 0) {
            $context = $view->getContext();
            $context->setGroups($groups);
        }

        return $view;
    }

    /**
     * @return Pagerfanta
     */
    private function getPaginatedResult(): Pagerfanta
    {
        $adapter = new DoctrineORMAdapter($this->getQueryBuilder());

        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta
            ->setMaxPerPage($this->request->query->get('limit', self::MAX_RESULTS))
            ->setCurrentPage($this->request->query->get('page', 1));

        if (null !== $this->request->query->get('noLimit')) {
            $pagerfanta->setMaxPerPage(999999);
        }

        return $pagerfanta;
    }

    /**
     * Create final return array with data needed + items per page etc.
     *
     * @param Pagerfanta $pagerfanta
     *
     * @return array
     */
    public function transformIterator(Pagerfanta $pagerfanta): array
    {
        return [
            'data' => iterator_to_array($pagerfanta->getCurrentPageResults()),
            'page' => $pagerfanta->getCurrentPage(),
            'pages' => $pagerfanta->getNbPages(),
            'max' => $pagerfanta->getNbResults(),
            'offes' => $pagerfanta->getMaxPerPage(),
        ];
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): self
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @return QueryBuilder
     */
    public function convertRequest(): QueryBuilder
    {
        return $this->qb;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        $qb = $this->convertRequest();

        return $qb;
    }
}
