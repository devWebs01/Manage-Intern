<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AssessmentIndicatorModel extends Model
{
    use HasFactory;
    protected $table = 'assessment_indicators';
    protected $primaryKey = 'id';
    public $timestamps = true; // otomatis mengelola created_at/updated_at
    protected $fillable = [
        'component',
    ];

   // Satu indikator digunakan oleh banyak penilaian peserta
   public function assessments()
   {
       return $this->hasMany(\App\Models\ParticipantAssessmentModel::class, 'indicator_id', 'id');
   }
}
