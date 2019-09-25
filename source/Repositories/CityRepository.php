<?php

namespace DevBoot\Repository;

use DevBoot\Interfaces\CityRepoInterface;
use DevBoot\Repository\AbstractDefaultRepository;
use DevBoot\Support\Message;
use DevBoot\Support\Pager;
use DevBoot\Models\State;
use DevBoot\Models\City;
use DevBoot\Models\UnitCity;

class CityRepository extends AbstractDefaultRepository implements CityRepoInterface
{

    protected $modelClass = City::class;
    /**
     * People constructor.
     */
    public function __construct()
    {
        $this->message = new Message();
    }

    public function create(array $data): bool
    {

        if ($data['name'] == "") {
            $this->message->error("O nome do bairro não pode ser vazio");
            return false;
        }

        $data['name'] = strtoupper(str_space($data['name']));

        $create = new District;
        $create->fill($data);
        if ($create->save()) {
        }

        $this->id = $create->id;
        return true;
    }

    public function update(array $data): bool
    {

    }

    public function delete(object $delete): bool
    {

    }

    public function all(): object
    {
        return City::all();
    }

    public function getCities(array $filter, int $take, bool $paginate): object
    {
        $query = parent::newQuery();
        $query->when($filter['states_id'], function($q) use ($filter) {
            $q->where('states_id', '=', $filter['states_id']);
        })->orderBy('name', 'ASC');
        return $this->doQuery($query, $filter, $take, $paginate);
    }

    public function returnUf(): object
    {
        return State::all();
    }

    public function pager()
    {
        return $this->pager;
    }

    public function post()
    {
        return $this->post;
    }
}
