<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kyslik\ColumnSortable\Sortable;

class City extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = [
        'name'
    ];
    protected $fillable = ['name'];

    public function departure_vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'departure_city_id');
    }

    public function destination_vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'destination_city_id');
    }
}
