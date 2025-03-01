<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class ParticipantsModel extends Model
{

	protected $table = 'participants';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = [
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
	protected $useTimestamps = false;
	protected $createdField = 'created_at';
	protected $updatedField = 'updated_at';
	protected $deletedField = 'deleted_at';
	protected $validationRules = [
		'full_name'   => 'required',
		'institution' => 'required',
		'level'       => 'required',
		'start_date'  => 'required|valid_date',
		'end_date'    => 'required|valid_date',
		'status'      => 'required|in_list[Active, Completed, Dropped]'
	];	
	protected $validationMessages = [
        'full_name' => ['required' => 'Nama lengkap wajib diisi.'],
        'institution' => ['required' => 'Institusi wajib diisi.'],
        'level' => ['required' => 'Level wajib diisi.'],
        'start_date' => [
            'required' => 'Tanggal mulai wajib diisi.',
            'valid_date' => 'Format tanggal mulai tidak valid.'
        ],
        'end_date' => [
            'required' => 'Tanggal selesai wajib diisi.',
            'valid_date' => 'Format tanggal selesai tidak valid.'
        ],
        'status' => [
            'required' => 'Status wajib diisi.',
            'in_list' => 'Status harus salah satu dari: Active, Completed, Dropped.'
        ]
    ];
	protected $skipValidation = true;

	/**
     * Mendefinisikan relasi dengan model User
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id', 'user_id');
    }

}