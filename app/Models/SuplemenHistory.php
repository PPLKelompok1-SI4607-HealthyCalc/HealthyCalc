<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuplemenHistory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class)->withTrashed();
    }
}
