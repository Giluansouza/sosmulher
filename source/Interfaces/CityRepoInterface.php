<?php

namespace DevBoot\Interfaces;

interface CityRepoInterface
{
    public function create(array $data): bool;
    public function update(array $data): bool;
    public function delete(object $delete): bool;
    public function getCities(array $filter, int $take, bool $paginate): object;
}
