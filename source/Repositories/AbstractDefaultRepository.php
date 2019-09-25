<?php

namespace DevBoot\Repositories;

use DevBoot\Support\Message;
use DevBoot\Support\Pager;

/**
 * DevBoot | Class Default Repository Layer Supertype Pattern
 *
 * @author Giluan Souza <giluan@devboot.com.br>
 * @package DevBoot\Repository
 */
abstract class AbstractDefaultRepository
{

    /**
    * @var Message
    */
    protected $message;

    /**
    * @var Id
    */
    protected $id;

    /**
    * @var Name
    */
    protected $name;

    /**
    * @var Post
    */
    protected $post;
    /**
     * @var object
     */
    protected $oRepository;
    /**
    * @var Pager
    */
    protected $pager;

    /**
     * Model class for repository
     * @var string
     */
    protected $modelClass;

    public function __construct()
    {
        $this->message = new Message();
    }

    /**
     * Instance Class
     * @return EloquentQueryBuilder | QueryBuilder
     */
    protected function newQuery()
    {
        return app($this->modelClass)->newQuery();
    }

    public function findById(int $id, $fail = true): object
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }
        return $this->newQuery()->find($id);
    }

    public function doQuery($query, array $filter, int $take, bool $paginate): object
    {

        if (is_null($query)) {
            $query = $this->newQuery();
        }

        if (true == $paginate) {
            $this->pager = new Pager(url($filter['url']));
            $this->pager->pager($query->count(), $take, ($filter['page'] ?? 1));
            return $query->limit($this->pager->limit())->offset($this->pager->offset())->get();
        }

        return $query->get();
    }

    /**
     * Método genérico para retornar todos os elementos em query
     * @param  array  $filter
     * @param  int    $take     Quantidade de resultados por página
     * @param  bool   $paginate True|false para paginação
     * @return array
     */
    public function getAll(array $filter, int $take, bool $paginate): object
    {
        return $this->doQuery(null, $filter, $take, $paginate);
    }
    /**
    * @return Message|null
    */
    public function message(): ?Message
    {
        return $this->message;
    }

    /**
    * @return Int
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
    * @return String
    */
    public function getName(): ?String
    {
        return $this->name;
    }
}
