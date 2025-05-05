<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDocument extends Model
{
    use HasFactory;

    protected $table = 'service_documents';

    protected $fillable = [
        'service_id', 
        'title',       
        'description', 
        'document',    
        'multi_documents', 
    ];

    protected $casts = [
        'multi_documents' => 'array',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
