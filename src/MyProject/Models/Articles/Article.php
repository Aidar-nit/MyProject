<?php 

namespace MyProject\Models\Articles;
use MyProject\Models\Users\User;
use MyProject\Services\DB;
use MyProject\Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
	
	protected $authorId;
	protected $name;
	protected $text;
	protected $createdAt;

	protected static function getTableName():string
	{
		return 'articles';
	}

	public function getAuthor():User 
	{
		return User::getById($this->authorId);
	}

	
	public function getAuthorId():int 
	{
		return $this->authorId;
	}
	public function getName():string 
	{
		return $this->name;
	}
	public function getText():string 
	{
		return $this->text;
	}
	public function getCreatedAt():string 
	{
		return $this->createdAt;
	}

	public function setName($name):void
	{
		$this->name = $name;
	}
	public function setText($text):void
	{
		$this->text = $text;
	}
	public function setAuthor(User $author):void
	{
		$this->authorId = $author->getId();
	}
}


?>