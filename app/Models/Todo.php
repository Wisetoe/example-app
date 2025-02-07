<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'status',
    ];
    
    public function scopeFilter($query, $filters)
    {
        $query->when(isset($filters['search']), function ($query) use ($filters) {
            return $query->where('title', 'like', '%' . $filters['search'] . '%');
        });

        $query->when(isset($filters['status']), function ($query) use ($filters) {
            return $query->where('status', $filters['status']);
        });

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
