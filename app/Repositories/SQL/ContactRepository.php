<?php

namespace App\Repositories\SQL;

use App\Models\Contact;
use App\Repositories\Contracts\ContactContract;

class ContactRepository extends BaseRepository implements ContactContract
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function updateById(int $id, array $data)
    {
        $contact = $this->findById($id);
        $contact->update($data);
        return $contact;
    }

    public function deleteById(int $id)
    {
        $contact = $this->findById($id);
        return $contact->delete();
    }
}
