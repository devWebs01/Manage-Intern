<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class PresencesModel extends Model
{

	protected $table = 'presences';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = [
		'participant_id',
		'date',
		'check_in',
		'check_out'
	];
	protected $useTimestamps = false;
	protected $createdField = 'created_at';
	protected $validationRules = [
		'participant_id' => 'required|integer|is_natural_no_zero',
		'date' => 'required|valid_date[Y-m-d]',
		'check_in' => 'required|valid_date[H:i:s]',
		'check_out' => 'permit_empty|valid_date[H:i:s]',
	];

	protected $validationMessages = [
		'participant_id' => [
			'required' => 'Participant ID harus diisi.',
			'integer' => 'Participant ID harus berupa angka.',
			'is_natural_no_zero' => 'Participant ID tidak valid.',
		],
		'date' => [
			'required' => 'Tanggal harus diisi.',
			'valid_date' => 'Format tanggal tidak valid (YYYY-MM-DD).',
		],
		'check_in' => [
			'required' => 'Waktu check-in harus diisi.',
			'valid_date' => 'Format waktu check-in tidak valid (HH:mm:ss).',
		],
		'check_out' => [
			'valid_date' => 'Format waktu check-out tidak valid (HH:mm:ss).',
		],
	];
	protected $skipValidation = false;

}