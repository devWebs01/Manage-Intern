<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogbooksModel extends Model
{
    protected $table = 'logbooks';
    protected $primaryKey = 'id';
    // Jika tidak ingin Eloquent mengelola created_at/updated_at secara otomatis, set false.
    public $timestamps = true; 
    // Daftar field yang boleh diisi secara mass assignment.
    protected $fillable = [
        'participant_id',
        'date',
        'activity'
    ];

    public function participant()
    {
        return $this->belongsTo(\App\Models\ParticipantsModel::class, 'participant_id', 'id');
    }
}
