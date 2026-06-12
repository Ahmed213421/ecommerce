<?php

namespace App\Services\Admin;

use App\Models\Testmonial;

class AdminTestmonialService
{
    public function getAllTestmonials()
    {
        return Testmonial::latest()->get();
    }

    public function updateTestmonial($id, array $data)
    {
        $testmonial = Testmonial::find($id);
        if ($testmonial) {
            return $testmonial->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'subject' => $data['subject'],
                'message' => $data['message'],
            ]);
        }
        return false;
    }

    public function deleteTestmonial($id)
    {
        $testmonial = Testmonial::find($id);
        if ($testmonial) {
            return $testmonial->delete();
        }
        return false;
    }
}
