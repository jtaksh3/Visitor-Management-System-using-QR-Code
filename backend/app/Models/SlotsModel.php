<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class SlotsModel extends Model
{
	protected $table      = _SLOTS_TABLE;
    protected $primaryKey = _ID;
    protected $returnType = _RETURN_TYPE;
    protected $allowedFields = [_VISITOR_ID, _HOST_ID, _MEETING_AT, _STATUS];
    protected $useTimestamps = true;
    protected $createdField  = _CREATED_AT;
    protected $updatedField  = _UPDATED_AT;
}

