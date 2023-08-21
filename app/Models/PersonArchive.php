<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonArchive extends Model
{
    use HasFactory;

    protected $table = 'people_archive';

    protected $fillable = ['member_id', 'name', 'email'];
}
