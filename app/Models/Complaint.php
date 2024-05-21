<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'reply',
        'ticket_number',
    ];

    // Automatically generate a ticket number when a complaint is created
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ticket_number = 'TICKET-' . strtoupper(uniqid());
        });
    }
}
