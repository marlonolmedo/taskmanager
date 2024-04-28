<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyect;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'proyect_id', 'priority', 'description', 'sortpriority'];
    public function proyect()
    {
        return $this->belongsTo(Proyect::class);
    }
}
