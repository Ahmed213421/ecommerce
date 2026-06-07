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

    public function updateById(int $id, array $data)
    {
        $contact = $this->findOrFail($id);
        return $this->update($contact, $data);
    }

    public function deleteById(int $id)
    {
        $contact = $this->findOrFail($id);
        return $this->remove($contact);
    }
}
