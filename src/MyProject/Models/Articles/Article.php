<?php 

namespace MyProject\Models\Articles;
use MyProject\Models\Users\User;
use MyProject\Services\DB;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;



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


	public static function createFromArray(array $fields, User $author):Article
	{
		if (empty($fields['name'])) {
			throw new InvalidArgumentException('Не передано название статьи');
		}
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст статьи');
		}

		$article = new Article();

		$article->setAuthor($author);
		$article->setName($fields['name']);
		$article->setText($fields['text']);

		$article->save();

		return $article;
	}
}


?>