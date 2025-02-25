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
	protected $validationRules = [];
	protected $validationMessages = [];
	protected $skipValidation = true;

}