<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   protected $fillable = [
        'taskname',
        'description',
        'urgency',
        'comments',
        'assigned_to',
        'due_date',
        'assignee',
        'status', 
    ];


    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
