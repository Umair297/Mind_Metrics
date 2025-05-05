<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessments'; 

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'primary_phone',
        'alternate_phone',
        'emergency_phone',
        'parent_name',
        'student_language',
        'home_language',
        'parent_language',
        'case_manager_name',
        'case_manager_phone',
        'case_manager_email',
        'school_name',
        'notes',
        'assessment_type',
        'eld_level',
        'date_consent_received',
        'due_date',
        'anticipated_iep_date',
        'provider',
        'assessment_areas',
        'eligibility',
        'status',
        'attachments'
    ];
    public function documents()
{
    return $this->hasMany(Document::class);
}
public function school()
{
    return $this->belongsTo(School::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
