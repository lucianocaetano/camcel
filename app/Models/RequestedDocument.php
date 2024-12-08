<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 
        'enterprise_id',
        'document_name', 
        'document_url', 
        'document_type',
        'datatang', 
        'valido', 
        'operator_id'
    ];
}
