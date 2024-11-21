<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public const ALLOWED_STATUSES = ['pending', 'in_progress', 'completed'];
}