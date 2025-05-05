<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'assessment_id',
        'title',
        'description',
        'document',
        'multi_documents',
    ];

    // Cast multi_documents to array
    protected $casts = [
        'multi_documents' => 'array',
    ];

    // Relationship: Document belongs to an Assessment
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
