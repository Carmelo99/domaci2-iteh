<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }


    public function user () {
        return $this->belongsTo(User::class);
    }
}
