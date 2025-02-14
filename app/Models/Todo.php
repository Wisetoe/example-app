<?php

namespace App\Models;

use App\Enums\Status;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'status',
    ];
    
    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($builder, $search) {
            return $builder->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['status'] ?? null, function ($builder, $status) {
                return $builder->where('status', $status);
        });

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
