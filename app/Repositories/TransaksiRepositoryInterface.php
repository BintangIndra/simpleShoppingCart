<?php
namespace App\Repositories;

interface TransaksiRepositoryInterface
{
    public function all();

    public function findById($id);

    public function update(array $data);

    public function delete(int $id);

    public function getTotal(array $data);

}