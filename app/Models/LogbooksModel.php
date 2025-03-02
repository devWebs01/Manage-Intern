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
		'participant_id'  => 'required',
		'date'  => 'required',
		'activity'  => 'required',
	];
	protected $validationMessages = [];
	protected $skipValidation = false;

}