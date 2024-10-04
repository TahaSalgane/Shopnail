<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'relationship', 'date_of_birth', 'user_id'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class); // Each family member belongs to a single user
    }
}
