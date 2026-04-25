<?php

namespace App\Repositories\Contracts;

interface SubscriberContract extends BaseContract
{
    public function findByEmail(string $email);
    public function findByToken(string $token);
    public function deleteByToken(string $token);
}
