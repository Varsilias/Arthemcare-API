<?php

namespace App\Models;

use App\Models\NextOfKin;
use App\Models\HealthRecord;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function nextOfKins()
    {
        return $this->hasMany(NextOfKin::class);
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }

    public function prescriptons()
    {
        return $this->hasMany(Prescription::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
