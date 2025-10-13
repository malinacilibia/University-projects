<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // defineste coloanele care pot fi completate in mod automat
    protected $fillable = [
        'name', 'email', 'profession', 'company', 'linkedin_url', 'status'
    ];

// stabileste o relatie de tip one-to-many cu modelul SuccessStory
    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }
}

