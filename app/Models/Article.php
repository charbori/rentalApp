<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attachment;

class Article extends Model
{
    use HasFactory;

    protected $table = "articles";
    protected $fillable = ['user_id', 'title', 'content', 'category'];

    protected $guarded = [];
    /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attachment()
    {
        return $this->hasMany(Attachment::class, 'articles_id');
    }
}
