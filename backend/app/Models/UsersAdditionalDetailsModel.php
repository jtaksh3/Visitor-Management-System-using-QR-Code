<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UsersAdditionalDetailsModel extends Model
{
	protected $table      = _USERS_TABLE;
    protected $primaryKey = _ID;
    protected $returnType = _RETURN_TYPE;
    protected $allowedFields = [_FULL_NAME, _DESIGNATION, _ORGANIZATION, _PHONE_NO, _ADDRESS_ID, _STATUS];
    protected $useTimestamps = true;
    protected $createdField  = _CREATED_AT;
    protected $updatedField  = _UPDATED_AT;
}

