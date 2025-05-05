<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_number',
    ];

    // 🔁 Relationship: A School has many Assessments
    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

}
