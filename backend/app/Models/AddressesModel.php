<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class AddressesModel extends Model
{
	protected $table      = _ADDRESSES_TABLE;
    protected $primaryKey = _ID;
    protected $returnType = _RETURN_TYPE;
    protected $allowedFields = [_ADDRESS_LINE_1, _ADDRESS_LINE_2, _ADDRESS_LINE_3, _CITY, _STATE, _COUNTRY, _PINCODE, _STATUS];
    protected $useTimestamps = true;
    protected $createdField  = _CREATED_AT;
    protected $updatedField  = _UPDATED_AT;
}

