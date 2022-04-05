<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $fillable = [
        'name',
        'user_id'
    ];

    public function notes(){
        return $this->hasMany(Note::class, 'tag_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
