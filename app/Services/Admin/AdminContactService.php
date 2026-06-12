<?php

namespace App\Services\Admin;

use App\Models\Contact;

class AdminContactService
{
    public function getAllContacts()
    {
        return Contact::latest()->get();
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            return $contact->delete();
        }
        return false;
    }
}
