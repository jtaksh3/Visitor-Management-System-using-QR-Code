<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class AuthenticationTokensModel extends Model
{
	protected $table      = _AUTHENTICATION_TOKENS_TABLE;
    protected $primaryKey = _ID;
    protected $returnType = _RETURN_TYPE;
    protected $allowedFields = [_USER_ID, _TOKEN];
    protected $useTimestamps = true;
    protected $createdField  = _CREATED_AT;
    protected $updatedField  = _UPDATED_AT;
}

