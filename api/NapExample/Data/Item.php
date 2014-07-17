<?php
namespace NapExample\Data;


class Item implements \JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var bool */
    private $isDone;

    public function __construct($id, $title, $isDone)
    {
        $this->id = $id;
        $this->isDone = $isDone;
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function isDone()
    {
        return $this->isDone;
    }

    /**
     * @param bool $isDone
     */
    public function setIsDone($isDone)
    {
        $this->isDone = $isDone;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return array(
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "complete" => $this->isDone()
        );
    }
}