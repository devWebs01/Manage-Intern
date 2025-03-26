<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresencesModel extends Model
{
    protected $table = 'presences';
    protected $primaryKey = 'id';
    // Jika Anda tidak ingin Eloquent mengelola created_at/updated_at secara otomatis:
    public $timestamps = true; 
    
    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'participant_id',
        'date',
        'check_in',
        'check_out'
    ];
    
    /**
     * Relasi ke model Participant.
     */
    public function participant()
    {
        return $this->belongsTo(\App\Models\ParticipantsModel::class, 'participant_id', 'id');
    }
}
