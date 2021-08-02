<?php namespace App\Database\Migrations;

class Add_Additional_User_Details extends \CodeIgniter\Database\Migration {

  public function up()
  {
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'constraint'     => 9,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'full_name'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'designation'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'organization'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '100',
        'null'           => true,
      ],
      'phone_no' => [
        'type'           => 'BIGINT',
        'constraint'     => '15',
        'null'           => true,
      ],
      'address_id' => [
        'type'           => 'INT',
        'constraint'     => '9',
        'null'           => true,
      ],
      'image_location' => [
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
    $this->forge->createTable('Users_Additional_Details');
  }

  public function down()
  {
    $this->forge->dropTable('Users_Additional_Details');
  }
}

