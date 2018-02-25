<?php

namespace App\Handler;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class ApiHandler.
 */
class ApiHandler
{
    private const MAX_RESULTS = 100;

    private const ENTITY_PATTERN = 'App\Entity\%s';

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

    protected $user;

    /**
     * ApiHandler constructor.
     *
     * @param RequestStack           $requestStack
     * @param EntityManagerInterface $em
     * @param ViewHandlerInterface   $viewHandler
     */
    public function __construct(RequestStack $requestStack, EntityManagerInterface $em, ViewHandlerInterface $viewHandler, TokenStorageInterface $tokenStorage)
    {
        $this->viewhandler = $viewHandler;
        $this->em = $em;
        $this->request = $requestStack->getCurrentRequest();
        $this->user = $tokenStorage->getToken()->getUser();
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
    public function getResource($id, $groups, $key = 'id')
    {
        return $this->repository->findOneBy([
            $key => $id,
        ]);
    }

    /**
     * @param array       $groups
     * @param string|null $id
     * @param string      $key
     *
     * @return Response
     */
    public function collect(array $groups, string $id = null, $key = 'id')
    {
        $view = $this->createView(
            $id ?
                $this->getResource($id, $groups, $key) :
                $this->transformIterator($this->getPaginatedResult()),
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    /**
     * @param string $message
     *
     * @return static
     */
    public function success($message = ''): JsonResponse
    {
        return JsonResponse::create([
            'successs' => true,
            'message' => $message,
        ], Response::HTTP_OK);
    }

    /**
     * @param array $groups
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function badResponse()
    {
        $view = $this->createView([
            'error' => true,
        ], [], Response::HTTP_BAD_REQUEST);

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    /**
     * @param $data
     * @param array $groups
     *
     * @return View
     */
    public function createView($data, array $groups, $status = Response::HTTP_OK): View
    {
        $view = View::create($data, $status);
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
     * @param $id
     * @param array $groups
     *
     * @return Response
     */
    public function updateEntry($id, array $params, array $groups)
    {
        $entity = $this->repository->findOneById($id);

        $view = $this->createView(
            $this->patchAction($entity, $params),
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
    }

    /**
     * @param array $params
     * @param array $groups
     *
     * @return Response
     */
    public function createEntry(array $params, array $groups, $auth = false, array $additional = [])
    {
        $entityClassName = $this->repository->getClassName();
        $entity = $this->em->getClassMetadata($entityClassName)->newInstance();

        foreach ($params as $param => $value) {
            $setter = sprintf('set%s', ucfirst($param));
            if (is_array($value)) {
                foreach ($value as $subKey => $subValue) {
                    $value = $this->em->getRepository(sprintf(self::ENTITY_PATTERN, ucfirst($param)))->findOneBy([
                        $subKey => $subValue,
                    ]);
                    $entity->$setter($value);
                }
            } else {
                $setter = sprintf('set%s', ucfirst($param));
                $entity->$setter($value);
            }
        }
        if ($auth) {
            $entity->setAccount($this->user);
        }
        foreach ($additional as $method => $val) {
            $entity->$method($val);
        }
        $this->em->persist($entity);
        $this->em->flush();

        $view = $this->createView(
            $entity,
            $groups
        );

        return $this->viewhandler->createResponse($view, $this->request, 'json');
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
     * @param string $key
     *
     * @return mixed
     */
    public function getParam(string $key)
    {
        return $this->request->attributes->get($key, null);
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
