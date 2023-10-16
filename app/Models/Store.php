<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
    ];


    public function owner()
    {
        return $this->belongStO(User::class, 'owner_id');
    }
}
