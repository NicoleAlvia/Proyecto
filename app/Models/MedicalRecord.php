<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model {
    protected $table = 'medical_records';
    protected $fillable = ['patient_id', 'description', 'date'];
}
