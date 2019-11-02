<?php

namespace App\Base;

interface BaseRepositoryInterface
{
    public function all($filters);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);
}
