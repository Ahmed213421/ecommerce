<?php

namespace App\Repositories\Contracts;

interface SubscriberContract
{
    public function create(array $data);
    public function findById(int $id);
    public function findByEmail(string $email);
    public function findByToken(string $token);
    public function deleteById(int $id);
    public function deleteByToken(string $token);
}
