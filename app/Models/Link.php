<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class Link extends BaseModel
{
    use HasFactory;

    public function linkable()
    {
        return $this->morphTo();
    }


}
