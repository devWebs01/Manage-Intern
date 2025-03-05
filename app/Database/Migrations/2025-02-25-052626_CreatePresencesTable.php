<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePresencesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'participant_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'date'          => ['type' => 'DATE'],
            'check_in'        => ['type' => 'TIME'],
            'check_out'        => ['type' => 'TIME', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('participant_id', 'participants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('presences');
    }

    public function down()
    {
        $this->forge->dropTable('presences', true);
    }
}
