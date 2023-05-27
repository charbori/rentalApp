<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MapList;

class SportsRecord extends Model
{
    use HasFactory;

    protected $table = "sports_record";
    protected $fillable = ['user_id', 'map_id', 'type', 'record'];

    protected $guarded = [];

    /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(MapList::class);
    }
}
