<?php

namespace DevBoot\Repositories;

use DevBoot\Interfaces\OccurrenceRepoInterface;
use DevBoot\Repositories\AbstractDefaultRepositor;
use DevBoot\Models\Occurrence;
use DevBoot\Models\Relationship;
use DevBoot\Models\People;
use DevBoot\Support\Message;

class OccurrenceRepository extends AbstractDefaultRepository implements OccurrenceRepoInterface
{

    protected $modelClass = Occurrence::class;
    protected $model;

    public function __construct()
    {
        $this->model = new Occurrence;
        $this->message = new Message();
    }

    /**
     * Cadastra a ocorrência, não é verificado se existe duplicidade de ocorrência
     * @var Occurrence
     */
    public function create(
        ?int $users_id,
        int $type,
        string $real_time,
        string $plaintiff,
        string $precautionary_measure,
        string $name_victim,
        string $name_accused,
        string $note,
        string $ip_plaintiff,
        string $plaintiff_coordinates
    )
    {

        try {
            $newOccurrence = $this->model;

            $newOccurrence->users_id = $users_id;
            $newOccurrence->type = $type;
            $newOccurrence->real_time = $real_time;
            $newOccurrence->plaintiff = $plaintiff;
            $newOccurrence->precautionary_measure = $precautionary_measure;
            $newOccurrence->name_victim = $name_victim;
            $newOccurrence->name_accused = $name_accused;
            $newOccurrence->note = $note;
            $newOccurrence->ip_plaintiff = $ip_plaintiff;
            $newOccurrence->plaintiff_coordinates = $plaintiff_coordinates;

            if (!$newOccurrence->save()) {
                $this->message->error("Não foi possível cadastrar a ocorrência");
                return false;
            }
        } catch (\PDOException $e) {
            $this->message->error("Erro: ".$e->getMessage());
            return false;
        }

        return $newOccurrence;
    }

    public function update(array $data): bool
    {
        $update = Occurrence::find($data['occurrence_id']);
        $update->police_unit_id = $data['police_unit_id'];
        $update->address_id = $data['address_id']?:null;
        $update->source = $data['source'];
        $update->source_number = $data['source_number']?:null;
        $update->date_fact = $data['date_fact'];
        $update->fact_time = $data['fact_time'];
        $update->time_interval = $data['time_interval'];
        $update->weapon = $data['weapon'];
        $update->caliber = $data['caliber'];
        $update->type_vehicle = $data['type_vehicle'];
        $update->comments = $data['comments'];
        if (isset($data['reserved_note'])) {
            $update->reserved_note = $data['reserved_note'];
        }
        $update->motivation = $data['motivation'];
        if (!$update->save()) {
            $this->message->error("Não foi possível salvar o endereço");
            return false;
        }
        $this->id = $update->id;
        return true;
    }

    public function delete(object $delete): bool
    {
        // Apagar todos os relacionamentos
        $delete->People()->detach();
        // Apagar a ocorrência
        if (!$delete->delete()) {
            $this->message->error("Não foi possível remover a ocorrência.")->flash();
            return false;
        }
        return true;
    }

    /**
     * Retorna a lista de ocorrências de acordo com o tipo
     * @param  array  $filter - Date start, final / city / unit / page / url
     * @param  int    $take
     * @return object
     */
    public function getOccurrences(array $filter, int $take = 10, bool $paginate = false): object
    {
        $query = parent::newQuery();
        $query->where("type", '=', $filter['type'])
            ->with(['User'])
            ->orderBy('updated_at', 'DESC')
            ->orderBy('status', 'DESC');

        return $this->doQuery($query, $filter, $take, $paginate);
    }

    public function getAllOccurrences(array $filter, int $take = 10, bool $paginate = true): object
    {
        $query = parent::newQuery();
        $query->whereBetween('date_fact', [$filter['start'], $filter['final']])
            ->when($filter['unit'], function ($q) use ($filter) {
                $q->where('police_unit_id', $filter['unit']);
            })->when($filter['city'], function ($q) use ($filter) {
                $q->whereHas('address', function($query) use ($filter) {
                    $query->where('city_id', $filter['city']);
                });
            })->orderBy('date_fact', 'DESC');
        return $this->doQuery($query, $filter, $take, $paginate);
    }

    public function findById(int $id, $fail = false): object
    {
        // if ($fail) {
        //     return $this->newQuery()->findOrFail($id);
        // }
        return $this->newQuery()
                // ->where("id", "=", $id)
                ->with(['Address'])
                ->find($id);
    }

    /**
     * Retorna todas as ocorrências cadastradas de acordo com o filtro de Relacionamento (hasRelation)
     * @param  array  $filter
     * @param  int $limit
     * @param  int $offset
     * @return object
     */
    public function list(array $filter, int $limit, int $offset): object
    {
        return ($this->newQuery())::when($filter['unit'], function ($q) use ($filter) {
                            $q->where('police_unit_id', $filter['unit']);
                        })->when($filter['city'], function ($q) use ($filter) {
                            $q->whereHas('address', function($query) use ($filter) {
                                $query->where('city_id', $filter['city']);
                            });
                        })
                        ->with(['Relationship'])
                        ->whereBetween('date_fact', $filter)
                        ->hasRelation()
                        ->orderBy('date_fact', 'DESC')->limit($limit)->offset($offset)
                        ->get();
    }

    public function total(array $filter, string $raw, array $group, string $order): object
    {
        $query = parent::newQuery();
        $post = $query->whereHas('Units', function($q){
                        $q->where('status', 1)->where('adm_unit', 'CPRN');
                    })->when($filter['unit'], function($q) use ($filter) {
                        $q->where('occurrences.police_unit_id', $filter['unit']);
                    })->when($filter['city'], function ($q) use ($filter) {
                        $q->whereHas('address', function($query) use ($filter) {
                            $query->where('city_id', $filter['city']);
                        });
                    })
                    ->whereBetween('date_fact', [$filter['start'], $filter['final']])
                    ->join('relationship_people_occurrences as rel', 'occurrences.id', '=', 'rel.occurrence_id')
                    ->join('police_units as pu', 'occurrences.police_unit_id', '=', 'pu.id')
                    ->selectRaw($raw)
                    ->where('involvement', '=', 'VITIMA')
                    ->where(function($query){
                        $query->where('occurrence_type_id', '=', 1)
                        ->orWhere('occurrence_type_id', '=', 3)
                        ->orWhere('occurrence_type_id', '=', 4)
                        ->orWhere('occurrence_type_id', '=', 5);
                    })->when($group, function ($q) use ($group, $order) {
                        $q->groupBy($group)
                        ->orderBy($order, 'DESC');
                    });

        return $post->get();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function pager()
    {
        return $this->pager;
    }
}
