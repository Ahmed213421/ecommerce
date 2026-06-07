<?php

namespace App\Repositories\SQL;

use App\Models\Subscriber;
use App\Repositories\Contracts\SubscriberContract;

class SubscriberRepository extends BaseRepository implements SubscriberContract
{
    public function __construct(Subscriber $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByToken(string $token)
    {
        return $this->model->where('unsubscribe_token', $token)->first();
    }

    public function deleteById(int $id)
    {
        $subscriber = $this->findOrFail($id);
        return $this->remove($subscriber);
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
