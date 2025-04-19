<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'mentor_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'institution' => ['type' => 'VARCHAR', 'constraint' => 255],
            'level' => ['type' => 'ENUM', 'constraint' => ['SMA', 'SMK', 'D3', 'S1', 'S2', 'Other'], 'default' => 'Other'],
            'start_date' => ['type' => 'DATE'],
            'end_date' => ['type' => 'DATE'],
            'status' => ['type' => 'ENUM', 'constraint' => ['Active', 'Completed', 'Dropped'], 'default' => 'Active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);

        // Foreign key untuk user_id
        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE', // ON DELETE
            'CASCADE'  // ON UPDATE
        );

        // Foreign key untuk mentor_id
        $this->forge->addForeignKey(
            'mentor_id',
            'users',
            'id',
            'SET NULL', // ON DELETE SET NULL supaya tidak error kalau mentor dihapus
            'CASCADE'   // ON UPDATE
        );

        $this->forge->createTable('participants');
    }


    public function down()
    {
        $this->forge->dropTable('participants', true);
    }
}
