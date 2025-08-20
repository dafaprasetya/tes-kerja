<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $fillable = [
        'topik_id', 'nama_dataset', 'meta_data_json', 'metadata_info', 'files', 'last_update', 'user_id'
    ];


    public function topik(){
        return $this->belongsTo(Topik::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
