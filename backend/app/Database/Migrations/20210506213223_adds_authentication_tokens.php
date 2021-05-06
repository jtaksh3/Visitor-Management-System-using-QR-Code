<?php namespace App\Database\Migrations;

class Add_Authentication_Tokens extends \CodeIgniter\Database\Migration {

  public function up()
  {
    $this->forge->addField([
      'id'          => [
        'type'           => 'INT',
        'constraint'     => 9,
        'unsigned'       => TRUE,
        'auto_increment' => TRUE
      ],
      'user_id'       => [
        'type'           => 'INT',
        'constraint'     => '9',
        'null'           => true,
      ],
      'token'       => [
        'type'           => 'INT',
        'constraint'     => '9',
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
    $this->forge->createTable('AuthenticationTokens');
  }

  public function down()
  {
    $this->forge->dropTable('AuthenticationTokens');
  }
}

