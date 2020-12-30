<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TweetImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
    ];

    protected $appends = [
        'url',
    ];
    
    function getUrlAttribute(){
        return Storage::url($this->path);
    }
}
