<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorTracking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'developer_id',
        'project_id',
        'date',
        'error_type',
        'solution_description',
        'solution_provided_by',
        'status',
        'comments',
    ];

    /**
     * Get the developer associated with the error tracking record.
     */
    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    /**
     * Get the project associated with the error tracking record.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
