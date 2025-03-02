<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class LogbooksModel extends Model
{

	protected $table = 'logbooks';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = [
		'participant_id' ,
		'date',
		'activity',
		'created_at'
	];
	protected $useTimestamps = false;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $validationRules = [
        'participant_id' => 'required|integer|is_natural_no_zero',
        'date'           => 'required|valid_date[Y-m-d]',
        'activity'       => 'required|min_length[10]|max_length[1000]',
    ];

    protected $validationMessages = [
        'participant_id' => [
            'required'            => 'Participant ID harus diisi.',
            'integer'             => 'Participant ID harus berupa angka.',
            'is_natural_no_zero'  => 'Participant ID harus berupa angka positif.',
        ],
        'date' => [
            'required'   => 'Tanggal harus diisi.',
            'valid_date' => 'Format tanggal tidak valid. Gunakan format YYYY-MM-DD.',
        ],
        'activity' => [
            'required'   => 'Kegiatan harus diisi.',
            'min_length' => 'Kegiatan minimal 10 karakter.',
            'max_length' => 'Kegiatan maksimal 1000 karakter.',
        ],
    ];
	protected $skipValidation = false;

}