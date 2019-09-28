<?php

namespace DevBoot\Repositories;

use DevBoot\Repositories\AbstractDefaultRepository;
use DevBoot\Models\Address;
use DevBoot\Support\Message;

class AddressRepository extends AbstractDefaultRepository
{
    protected $modelClass = Address::class;
    protected $model;

    public function __construct()
    {
        $this->model = new Address;
        $this->message = new Message();
    }

    public function create(
        ?int $users_id,
        int $city_id,
        int $occurrences_id,
        string $cep,
        string $public_place,
        string $complement,
        string $district,
        string $coordinates)
    {
        try {
            $newAddress = $this->model;

            $newAddress->users_id = $users_id;
            $newAddress->city_id = $city_id;
            $newAddress->occurrences_id = $occurrences_id;
            $newAddress->cep = $cep;
            $newAddress->public_place = $public_place;
            $newAddress->complement = $complement;
            $newAddress->district = $district;
            $newAddress->coordinates = $coordinates;

            if (!$newAddress->save()) {
                $this->message->error("Não foi possível cadastrar o endereço");
                return false;
            }
        } catch (\PDOException $e) {
            $this->message->error("Não foi possível cadastrar o endereço");
            return false;
        }

        $this->id = $newAddress->id;
        return $newAddress;
    }

    public function update(array $data): bool
    {
        $address = Address::find($data['address_id']);
        $address->city_id = $data['city_id'];
        $address->district_id = $data['district_id']??null;
        $address->zone = (isset($data['zone']) && $data['zone'] != "") ? $data['zone'] : "";
        $address->district = $data['district']??"";
        $address->public_place = $data['public_place'];
        $address->latitude = ($data['latitude'] != "") ? $data['latitude'] : null;
        $address->longitude = ($data['longitude'] != "") ? $data['longitude'] : null;
        if (!$address->save()) {
            $this->message->error("Não foi possível salvar o endereço");
            return false;
        }
        return true;
    }

    public function delete(int $id): bool
    {
        $address = Address::find($id);
        $address->delete();

        return true;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
