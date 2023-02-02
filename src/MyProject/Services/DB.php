<?php 
namespace MyProject\Services;
use MyProject\Exceptions\DbException;

class DB
{
	private $pdo;

	private static $instance;

	private function __construct()
	{	
		$dbOptions = (require __DIR__.'/../../settings.php')['db'];
		try {
			$this->pdo = new \PDO(
				'mysql:host='.$dbOptions['host'].';dbname='.$dbOptions['dbname'],
				$dbOptions['user'],
				$dbOptions['password']
			);
			$this->pdo->exec('SET NAMES UTF8');
		} catch (\PDOException $e) {
			throw new DbException('Ошибка при подключении к базе данных: '. $e->getMessage());
		}
				
		
		
	}

	public static function getInstance():self 
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function query(string $sql,$params = [],$className):?array
	{
		$sth = $this->pdo->prepare($sql);
		$result = $sth->execute($params);
		if ($result === FALSE) {
			return null;
		}
		return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
	}

	public function getLastInsertId():int 
	{
		return (int) $this->pdo->lastInsertId();
	}
}


?>