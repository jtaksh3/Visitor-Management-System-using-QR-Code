<?php namespace App\Database\Migrations;

class Add_Address extends \CodeIgniter\Database\Migration {

  public function up()
  {
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'constraint'     => 9,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'address_line_1'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'address_line_2' => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'address_line_3'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'city'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'state' => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'country'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'status'       => [
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
    $this->forge->createTable('Addresses');
  }

  public function down()
  {
    $this->forge->dropTable('Addresses');
  }
}

