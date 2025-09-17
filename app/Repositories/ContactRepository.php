<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    protected $model;

    public function __construct(Contact $model)
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

    public function all()
    {
        return $this->model->all();
    }

    public function update(int $id, array $data)
    {
        $contact = $this->findById($id);
        $contact->update($data);
        return $contact;
    }

    public function delete(int $id)
    {
        $contact = $this->findById($id);
        return $contact->delete();
    }
}
