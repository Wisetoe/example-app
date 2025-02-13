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
        if(isset($filters['search'])) {
            return $query->where('title', 'like', '%' . $filters['search'] . '%');
        };

        if (isset($filters['status'])) {
            return $query->where('status', $filters['status']);
        };

        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
