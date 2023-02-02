<?php 

namespace MyProject\Models\Users;
use MyProject\Services\DB;
use MyProject\Models\ActiveRecordEntity;


class User extends ActiveRecordEntity
{

	protected $nickname;
	protected $email;
	protected $isConfirmed;
	protected $role;
	protected $passwordHash;
	protected $authToken;
	protected $createdAt;

	

	protected static function getTableName():string
	{
		return 'users';
	}


	public function getNickName():string
	{
		return $this->nickname;
	}
}


?>