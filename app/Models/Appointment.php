<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_date',
        'scheduled_time',
        'type',
        'description',
        'doctor_id',
        'patient_id',
        'specialty_id',
        'status',
    ];

    public function specialty():BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function doctor():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function patient():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getScheduledTime12Attribute()
    {
        return (new Carbon($this->scheduled_time))->format('g:i A');
    }

    public function cancellation()
    {
        return $this->hasOne(CancelledAppointment::class);
    }

    public function getFormatStatusAttribute()
    {
        $status = $this->attributes['status'];

        if($status == 'reserved'){
            $status = 'Reservada';
        }elseif($status == 'confirmed'){
            $status = 'Confirmada';
        }elseif($status == 'completed'){
            $status = 'Completada';
        }elseif($status == 'cancelled'){
            $status = 'Cancelada';
        }
        return $status;
    }

    /*--------------------------------- Scope ---------------------------------*/

    /* Admin */
    public function scopeConfirmedAdmin($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeReservedAdmin($query)
    {
        return $query->where('status', 'reserved');
    }

    public function scopeCompletedAdmin($query)
    {
        return $query->whereIn('status', ['completed', 'cancelled']);
    }

    /* Doctor */
    public function scopeConfirmedDoctor($query)
    {
        return $query->where('status', 'confirmed')
        ->where('doctor_id', auth()->id());
    }

    public function scopeReservedDoctor($query)
    {
        return $query->where('status', 'reserved')
        ->where('doctor_id', auth()->id());
    }

    public function scopeCompletedDoctor($query)
    {
        return $query->whereIn('status', ['completed', 'cancelled'])
        ->where('doctor_id', auth()->id());
    }

    /* Patient */

    public function scopeConfirmedPatient($query)
    {
        return $query
        ->where('status', 'confirmed')
        ->where('patient_id', auth()->id());
    }

    public function scopeReservedPatient($query){
        return $query
        ->where('status', 'reserved')
        ->where('patient_id', auth()->id());
    }

    public function scopeCompletedPatient($query)
    {
        return $query
        ->whereIn('status', ['completed', 'cancelled'])
        ->where('patient_id', auth()->id());
    }
}
