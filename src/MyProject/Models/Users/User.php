<?php 

namespace MyProject\Models\Users;
use MyProject\Services\DB;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;


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
	
	/*public function isAdmin():bool
	{
		if($this->role !== 'admin')
		{
			return false;
		}
		return true;
	}*/

	public function isAdmin(): bool
	{
	    return $this->getRole() === 'admin';
	}
	
	public function getRole():string
	{
		return $this->role;
	}

	public function getAuthToken():string
	{
		return $this->authToken;
	}
	public function getPasswordHash():string
	{
		return $this->passwordHash;
	}

	public function getNickName():string
	{
		return $this->nickname;
	}

	public static function singUp(array $userData): User
	{
		if(empty($userData['nickname']))
		{
			throw new InvalidArgumentException('Enter name');
		}
		if(!preg_match('/^[a-zA-Z0-9]+$/',$userData['nickname']))
		{
			throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
		}
		if(empty($userData['email']))
		{
			throw new InvalidArgumentException("Enter email");
		}
		if(!filter_var($userData['email'], FILTER_VALIDATE_EMAIL))
		{
			throw new InvalidArgumentException('Email некорректен');
		}
		if(empty($userData['password']))
		{
			throw new InvalidArgumentException('Enter password');
		}
		if (mb_strlen($userData['password']) < 8) 
		{
			throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
		}

		if(static::findOneByColumn('nickname',$userData['nickname']) !== null)
		{
			throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
		}
	
		if (static::findOneByColumn('email', $userData['email']) !== null) 
		{
			throw new InvalidArgumentException('Пользователь с таким email уже существует');
		}

		$user = new User();
		$user->nickname = $userData['nickname'];
		$user->email = $userData['email'];
		$user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
		$user->isConfirmed = false;
		$user->role = 'user';
		$user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
		$user->save();

		return $user;
	}
	public function activate(): void
	{
		$this->isConfirmed = true;
		$this->save();
	}

	public static function login(array $loginData):User 
	{
		if (empty($loginData['email'])) {
			throw new InvalidArgumentException("Enter Email");
		}
		if (empty($loginData['password'])) {
			throw new InvalidArgumentException('Enter password');
		}
		$user = User::findOneByColumn('email',$loginData['email']);

		if ($user === null) {
			throw new InvalidArgumentException('Пользователя с таким емайл нет');
		}
		if (!password_verify($loginData['password'], $user->getPasswordHash())) {
			throw new InvalidArgumentException('неверный Пароль');
		}
		if (!$user->isConfirmed) {
			throw new InvalidArgumentException('Пользователь на подтвержден');
		}

		$user->refreshAuthToken();
		$user->save();

		return $user;
	}

	public function refreshAuthToken()
	{
		$this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
	}
}


?>