<?php

namespace DevBoot\Interfaces;

interface OccurrenceRepoInterface
{

    /**
     * Cadastrar denúncias
     * @param  int    $users_id
     * @param  string $precautionary_measure
     * @param  string $real_time
     * @param  string $plaintiff
     * @param  string $name_victim
     * @param  string $name_accused
     * @param  string $note
     * @param  string $ip_plaintiff
     * @param  string $plaintiff_coordinates
     * @return mixed
     */
    public function create(
        int $users_id,
        int $type,
        string $real_time,
        string $plaintiff,
        string $precautionary_measure,
        string $name_victim,
        string $name_accused,
        string $note,
        string $ip_plaintiff,
        string $plaintiff_coordinates);
    public function update(array $data): bool;
    public function delete(object $delete): bool;
    public function getOccurrences(array $filter, int $take, bool $paginate): object;
    public function getAllOccurrences(array $filter, int $take, bool $paginate): object;
}
