<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function getFormatNameAttribute()
    {
        $name = $this->attributes['name'];
        return ucfirst($name);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function doctors() : BelongsToMany {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function appointments() : BelongsToMany{
        return $this->belongsToMany(Appointment::class);
    }
}
