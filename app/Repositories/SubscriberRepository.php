<?php

namespace App\Repositories;

use App\Models\Subscriber;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;

class SubscriberRepository implements SubscriberRepositoryInterface
{
    protected $model;

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByToken(string $token)
    {
        return $this->model->where('unsubscribe_token', $token)->first();
    }

    public function delete(int $id)
    {
        $subscriber = $this->findById($id);
        return $subscriber->delete();
    }

    public function deleteByToken(string $token)
    {
        $subscriber = $this->findByToken($token);
        if ($subscriber) {
            return $subscriber->delete();
        }
        return false;
    }
}
