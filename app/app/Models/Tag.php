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
        return $this->hasMany(Tag::class);
    }
}