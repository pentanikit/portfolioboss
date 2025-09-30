<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'blog_id', 'reaction', 'fingerprint', 'ip', 'ua_hash', 'session_id'
    ];
}
