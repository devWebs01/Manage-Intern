<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAssessmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'participant_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'mentor_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'score'         => ['type' => 'INT', 'constraint' => 3],
            'remarks'       => ['type' => 'TEXT', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('participant_id', 'participants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mentor_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('assessments');
    }

    public function down()
    {
        $this->forge->dropTable('assessments', true);
    }
}
