<?php 
namespace MyProject\Models\Users;
use MyProject\Models\Users\User;

class UsersAuthService
{
	public static function createToken(User $user):void
	{
		$token = $user->getId() .':'.$user->getAuthToken();
		setcookie('token',$token, 0, '/', '', false, true);
	}

	public static function getUserByToken():?User 
	{
		$token = $_COOKIE['token'] ?? '';

		[$userId, $authToken] = explode(':', $token, 2);

		$user = User::getById((int) $userId);

		if ($user === null) {
			return null;
		}
		if ($user->getAuthToken() !== $authToken) {
			return null;
		}

		return $user;
	}
	public static function deleteToken()
	{
		setcookie('token','', 0, '/', '', false, true);
	}

}



?>