<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateParticipantAssessmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'participant_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'indicator_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'score' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        // Menambahkan foreign key jika tabel peserta dan indikator sudah ada
        $this->forge->addForeignKey('participant_id', 'participants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('indicator_id', 'assessment_indicators', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('participant_assessments');
    }

    public function down()
    {
        $this->forge->dropTable('participant_assessments');
    }
}
