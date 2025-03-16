<?php

namespace App\Models;

use Myth\Auth\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Faker\Generator;

/**
 * @method User|null first()
 */
class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = User::class;
    protected $useSoftDeletes = true;
    protected $fillable = [
        'email',
        'username',
        'password_hash',
        'reset_hash',
        'reset_at',
        'reset_expires',
        'activate_hash',
        'status',
        'status_message',
        'active',
        'force_pass_reset',
        'permissions',
        'deleted_at',

        // 
        'role',
        'avatar'
    ];
    protected $useTimestamps = true;

    protected $validationRules = [
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
    protected $validationMessages = [
        'email' => [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique' => 'Email sudah digunakan.',
        ],
        'username' => [
            'required' => 'Username wajib diisi.',
            'alpha_numeric_punct' => 'Username hanya boleh mengandung karakter alfanumerik dan tanda baca.',
            'min_length' => 'Username minimal 3 karakter.',
            'max_length' => 'Username maksimal 30 karakter.',
            'is_unique' => 'Username sudah digunakan.',
        ],
        'password' => [
            'min_length' => 'Password minimal 6 karakter.',
        ],
    ];
    protected $skipValidation = false;

    /**
     * Relasi ke model Participant (satu user memiliki satu peserta).
     */
    public function participant()
    {
        return $this->hasOne(\App\Models\ParticipantsModel::class, 'user_id', 'id');
    }

    public function mentor_participant()
    {
        return $this->hasMany(\App\Models\ParticipantsModel::class, 'mentor_id', 'id');
    }

    /**
     * Logs a password reset attempt for posterity sake.
     */
    public function logResetAttempt(string $email, ?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email' => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     */
    public function logActivationAttempt(?string $token = null, ?string $ipAddress = null, ?string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Faked data for Fabricator.
     */
    public function fake(Generator &$faker): User
    {
        return new User([
            'email' => $faker->email,
            'username' => $faker->userName,
            'password' => bin2hex(random_bytes(16)),
        ]);
    }
}
