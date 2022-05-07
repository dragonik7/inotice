<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'notes';
    protected $fillable = [
        'title',
        'text',
        'photos',
        'user_id',
        'tag_id'
    ];

    public function tags(){
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function favoriteUser(){
        return $this->belongsToMany(User::class,'favorites', 'note_id', 'user_id');
    }
}
