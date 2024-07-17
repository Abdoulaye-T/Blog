<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{

    protected $with = ['user'];
   // protected $fillable = ['content', 'post_id', 'user_id']; //les champs qui ne sont pas gardes et sur lesquels on va utiliser le Massasignement
    protected $guarded = ['id', 'created_at', 'update_at'];

    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
