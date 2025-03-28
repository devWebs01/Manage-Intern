<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCompanyProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'company_logo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'representative_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'position' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'signature' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'signature_code' => [
                'type' => 'TEXT', // JSON data bisa disimpan sebagai TEXT
                'null' => true,
                'after' => 'signature', // Letakkan setelah kolom signature (jika ada)
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('company_profiles');
    }

    public function down()
    {
        $this->forge->dropTable('company_profiles');
    }
}
