<?php namespace App\Database\Migrations;

class Add_Users extends \CodeIgniter\Database\Migration {

  public function up()
  {
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'constraint'     => 9,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'email'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'password' => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'role'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'user_additional_details_id' => [
        'type'           => 'INT',
        'constraint'     => '9',
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
    $this->forge->createTable('Users');
  }

  public function down()
  {
    $this->forge->dropTable('Users');
  }
}

