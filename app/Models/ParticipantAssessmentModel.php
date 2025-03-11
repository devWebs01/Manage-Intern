<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipantAssessmentModel extends Model
{
    protected $table = 'participant_assessments';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'participant_id',
        'indicator_id',
        'score',
    ];

    // Relasi ke indikator penilaian
    public function indicator()
    {
        return $this->belongsTo(\App\Models\AssessmentIndicatorModel::class, 'indicator_id', 'id');
    }

    // Relasi ke peserta
    public function participant()
    {
        return $this->belongsTo(\App\Models\ParticipantsModel::class, 'participant_id', 'id');
    }
}
