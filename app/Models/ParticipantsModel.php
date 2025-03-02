<?php

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
        'user_id'     => 'required|integer|is_natural_no_zero',
        'full_name'   => 'required|min_length[3]|max_length[255]',
        'institution' => 'required|min_length[3]|max_length[255]',
        'level'       => 'required',
        'start_date'  => 'required|valid_date[Y-m-d]',
        'end_date'    => 'required|valid_date[Y-m-d]',
        'status'      => 'required|in_list[Active, Completed, Dropped]'
    ];
    
    protected $validationMessages = [
        'user_id' => [
            'required'           => 'User ID wajib diisi.',
            'integer'            => 'User ID harus berupa angka.',
            'is_natural_no_zero' => 'User ID harus berupa angka positif.',
        ],
        'full_name' => [
            'required'   => 'Nama lengkap wajib diisi.',
            'min_length' => 'Nama lengkap minimal 3 karakter.',
            'max_length' => 'Nama lengkap maksimal 255 karakter.',
        ],
        'institution' => [
            'required'   => 'Institusi wajib diisi.',
            'min_length' => 'Institusi minimal 3 karakter.',
            'max_length' => 'Institusi maksimal 255 karakter.',
        ],
        'level' => [
            'required' => 'Level wajib diisi.',
        ],
        'start_date' => [
            'required'   => 'Tanggal mulai wajib diisi.',
            'valid_date' => 'Format tanggal mulai tidak valid. Format yang benar: YYYY-MM-DD.'
        ],
        'end_date' => [
            'required'   => 'Tanggal selesai wajib diisi.',
            'valid_date' => 'Format tanggal selesai tidak valid. Format yang benar: YYYY-MM-DD.'
        ],
        'status' => [
            'required' => 'Status wajib diisi.',
            'in_list'  => 'Status harus salah satu dari: Active, Completed, Dropped.'
        ],
    ];
    
    // Ubah menjadi false agar validasi dijalankan
    protected $skipValidation = false;

    /**
     * Mendefinisikan relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id', 'user_id');
    }
}
