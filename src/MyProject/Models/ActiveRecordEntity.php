<?php 
namespace MyProject\Models;
use MyProject\Services\DB;

abstract class ActiveRecordEntity
{
	protected $id;

	public function getId():int 
	{
		return $this->id;
	}

	public function __set($name, $values)
	{
		$camelCaseName = $this->underscoreToCamelCase($name);
		$this->$camelCaseName = $values;
	}
	private function underscoreToCamelCase(string $source)
	{
		return lcfirst(str_replace('_', '', ucwords($source,'_')));
	}
	public static function findAll():array 
	{
		$db = DB::getInstance();
		return $db->query('SELECT * FROM `'.static::getTableName().'`',[],static::class);
	}
	public static function getById(int $id):?self 
	{
		$db = DB::getInstance();
		$entities = $db->query('SELECT * FROM `'.static::getTableName().'` WHERE id = :idd',[':idd'=>$id],static::class);
		return $entities ? $entities[0] : null;
	}

	public function save(): void
	{
	    $mappedProperties = $this->mapPropertiesToDbFormat();
	    if ($this->id !== null) {
	        $this->update($mappedProperties);
	    } else {
	        $this->insert($mappedProperties);
	    }
	}

	private function mapPropertiesToDbFormat():array 
	{
		$reflector = new \ReflectionObject($this);
		$properties = $reflector->getProperties();
		$mappedProperties = [];

		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyNameAsUnderScore = $this->camelCaseToUnderscore($propertyName);
			$mappedProperties[$propertyNameAsUnderScore] = $this->$propertyName;
		}
		return $mappedProperties;
	}
	private function update(array $mappedProperties): void
	{
	    $columns2params = [];
	    $params2values = [];
	    $index = 1;
	    foreach ($mappedProperties as $column => $value) {
	        $param = ':param' . $index; // :param1
	        $columns2params[] = $column . ' = ' . $param; // column1 = :param1
	        $params2values[$param] = $value; // [:param1 => value1]
	        $index++;
	    }
	    $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
	    $db = Db::getInstance();
	    $db->query($sql, $params2values, static::class);
	}
	private function insert($mappedProperties):void 
	{	
		$filteredProperties = array_filter($mappedProperties);
		$columns = [];
		$paramsNames = [];
		$params2values = [];
		foreach ($filteredProperties as $columnName => $value) 
		{
			$columns[] = '`'.$columnName.'`';
			$paramName = ':' . $columnName;
			$paramsNames [] = $paramName; 
			$params2values [$paramName] = $value; 
		}

		$columnsViaSemicolon  = implode(', ',$columns);
		$paramsNamesViaSemicolon = implode(', ',$paramsNames);
		$sql = 'INSERT INTO '.static::getTableName().' ('.$columnsViaSemicolon.') VALUES ('.$paramsNamesViaSemicolon.')';
		$db = DB::getInstance();
		$db->query($sql,$params2values,static::class);
		$this->id = $db->getLastInsertId();
		$this->refresh();
	}

	private function refresh():void
	{
		$objectFromDb  = static::getById($this->id);
		foreach ($objectFromDb as $property  => $value) {
			$this->$property = $value;
		}
	}


	private function camelCaseToUnderscore(string $str):string
	{
		return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $str));
	}

	public static function findOneByColumn(string $columnName, $value): ?self
	{
		$db = DB::getInstance();
		$result = $db->query(
			'SELECT * FROM '.static::getTableName().' WHERE '.$columnName.' = :value LIMIT 1',
			[':value'=>$value],
			static::class
		);
		if($result === [])
		{
			return null;
		}
		return $result[0];
	}

	abstract protected static function getTableName():string;
}


?>