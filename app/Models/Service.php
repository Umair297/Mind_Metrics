<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services'; // Table name

    protected $fillable = [
        'student_first_name',
        'student_middle_name',
        'student_last_name',
        'phone_primary',
        'phone_alternate',
        'phone_emergency',
        'parent_name',
        'parent_phone',
        'parent_email',
        'student_home_language',
        'parent_language',
        'case_manager_name',
        'case_manager_phone',
        'case_manager_email',
        'school_name',
        'notes',
        'services_type',
        'eld_level',
        'service_minutes',
        'frequency',
        'provider',
        'eligibility',
        'status',
    ];
    public function serviceDocuments()
    {
        return $this->hasMany(ServiceDocument::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
