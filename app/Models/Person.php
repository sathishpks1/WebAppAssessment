<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['member_id', 'name', 'email'];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
