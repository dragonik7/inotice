<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';
    protected $fillable = [
        'title',
        'text',
        'image',
        'user_id',
        'tag_id'
    ];

    public function tags(){
        return $this->belongsTo(Note::class);
    }

}
