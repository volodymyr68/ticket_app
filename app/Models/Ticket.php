<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kyslik\ColumnSortable\Sortable;

class Ticket extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable =[
        'user_id',
        'vehicle_id',
        'seats_taken',
        'price'
    ];

    protected $sortable =[
        'user_id',
        'vehicle_id',
        'seats_taken',
        'price'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

}
