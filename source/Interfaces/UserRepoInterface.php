<?php

namespace DevBoot\Interfaces;

use DevBoot\Commands\UserCmd;

interface UserRepoInterface
{
    public function create($cpf, $email, $password);
    public function update(array $data): bool;
    public function delete(int $id): bool;
    public function getUsers(array $filter, int $take, bool $paginate, bool $all = true): object;
    public function getAllUsers(array $filter, int $take, bool $paginate): object;
}
