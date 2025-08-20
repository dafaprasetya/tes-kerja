<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    protected $fillable =['topik', 'user_id'];
    public function dataset() {
        return $this->hasMany(Dataset::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
