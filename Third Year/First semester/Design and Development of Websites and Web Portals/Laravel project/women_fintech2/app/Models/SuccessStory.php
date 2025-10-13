<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    use HasFactory;

// defineste coloanele care pot fi completate in mod automat
    protected $fillable = ['title', 'story', 'member_id'];

// stabileste relatia many to one cu modelul Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
