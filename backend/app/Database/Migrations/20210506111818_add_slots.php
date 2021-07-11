<?php namespace App\Database\Migrations;

class Add_Slots extends \CodeIgniter\Database\Migration {

  public function up()
  {
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'constraint'     => 9,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'visitor_id'       => [
        'type'           => 'INT',
        'constraint'     => '9',
        'null'           => true,
      ],
      'host_id'       => [
        'type'           => 'INT',
        'constraint'     => '9',
        'null'           => true,
      ],
      'meeting_at' => [
        'type'           => 'DATETIME',
      ],
      'visitor_status'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'host_status'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'created_at' => [
        'type'           => 'DATETIME',
      ],
      'updated_at'       => [
        'type'           => 'DATETIME',
      ],
    ]);
    $this->forge->addKey('id', TRUE, TRUE);
    $this->forge->createTable('Slots');
  }

  public function down()
  {
    $this->forge->dropTable('Slots');
  }
}

