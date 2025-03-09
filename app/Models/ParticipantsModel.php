<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipantsModel extends Model
{
    use SoftDeletes;
    
    protected $table = 'participants';
    protected $primaryKey = 'id';
    public $timestamps = true; // Pastikan tabel memiliki kolom created_at dan updated_at
    
    // Daftar kolom yang dapat diisi secara mass assignment
    protected $fillable = [
       'user_id',
        'full_name',
        'institution',
        'level',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected $dates = ['deleted_at'];
    
    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\UserModel::class, 'user_id', 'id');
    }

    /**
     * Relasi ke logbooks (banyak logbooks dimiliki oleh satu peserta)
     */
    public function logbooks()
    {
        return $this->hasMany(\App\Models\LogbooksModel::class, 'participant_id', 'id');
    }
    
    /**
     * Relasi ke assessments (penilaian) peserta
     */
    public function assessments()
    {
        return $this->hasMany(\App\Models\ParticipantAssessmentModel::class, 'participant_id', 'id');
    }
    
    /**
     * Relasi ke presences (absensi) peserta
     */
    public function presences()
    {
        return $this->hasMany(\App\Models\PresencesModel::class, 'participant_id', 'id');
    }
    
}
