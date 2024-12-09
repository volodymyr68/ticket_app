<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class Vehicle extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'quality',
        'departure_city_id',
        'destination_city_id',
        'seats_quantity',
        'ticket_cost',
        'departure_time'
    ];

    protected $sortable = [
        'quality',
        'departure_city_id',
        'destination_city_id',
        'seats_quantity',
        'ticket_cost',
        'departure_time'
    ];



    public function departureCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }

    public function destinationCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class,'vehicle_id');
    }

}
