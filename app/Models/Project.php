<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Order;

class Project extends Model
{
    use HasFactory;

    public function order(): HasMany
    {
        return $this->HasMany(Order::class);
    }
}
