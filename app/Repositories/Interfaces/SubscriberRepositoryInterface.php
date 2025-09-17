<?php

namespace App\Repositories\Interfaces;

interface SubscriberRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function findByEmail(string $email);
    public function findByToken(string $token);
    public function delete(int $id);
    public function deleteByToken(string $token);
}
