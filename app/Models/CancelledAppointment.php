<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'justification',
        'cancelled_by_id ',
        'appointment_id ',
    ];

    public function cancelled_by()
    {
        return $this->belongsTo(User::class);
    }
}
