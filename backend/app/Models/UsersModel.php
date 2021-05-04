<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersModel extends Model
{
	protected $table      = _USERS_TABLE;
    protected $primaryKey = _ID;
    protected $returnType = _RETURN_TYPE;
    protected $allowedFields = [_EMAIL, _PASSWORD, _ROLE, _USER_ADDITONAL_DETAILS_ID, _STATUS];
    protected $useTimestamps = true;
    protected $createdField  = _CREATED_AT;
    protected $updatedField  = _UPDATED_AT;
}

