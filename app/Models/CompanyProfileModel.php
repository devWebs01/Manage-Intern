<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfileModel extends Model
{
    protected $table = 'company_profiles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'company_name',
        'company_logo',
        'representative_name',
        'position',
        'signature',
        'signature_code'
    ];
}
