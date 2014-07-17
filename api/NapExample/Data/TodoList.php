<?php
namespace NapExample\Data;


class TodoList implements \JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var \NapExample\Data\Item[] */
    private $items = array();

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function addItem(\NapExample\Data\Item $item)
    {
        $this->items[] = $item;
    }

    public function addItems(array $items)
    {
        foreach($items as $i) {
            $this->addItem($i);
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \NapExample\Data\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param int $id
     * @return \NapExample\Data\Item|null
     */
    public function getItem($id)
    {
        foreach($this->getItems() as $item) {
            if($item->getId() === $id) {
                return $item;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
            "name" => $this->getName(),
            "items" => $this->getItems()
        );
    }
}