<?php

namespace NapExample\Data;


class TodoListsRepository
{
    private $data;
    private $dataPath;

    public function __construct($dataPath)
    {
        $this->data = json_decode(file_get_contents(realpath($dataPath)));
        $this->dataPath = $dataPath;
    }

    /**
     * @return \NapExample\Data\TodoList[]
     */
    public function getAll()
    {
        return array_map(
            function (\StdClass $lst) {
                return $this->createListFromJson($lst);
            },
            $this->data->{'todo-lists'}
        );
    }

    /**
     * @param   int   $id
     * @return  \NapExample\Data\TodoList|null
     */
    public function getTodoList($id)
    {
        foreach($this->data->{'todo-lists'} as $list){
            if($list->id === $id) {
                return $this->createListFromJson($list);
            }
        }

        return null;
    }

    private function createListFromJson(\StdClass $json)
    {
        $list = new \NapExample\Data\TodoList($json->id, $json->name);
        $children = array_map(
            function($item){
                return new \NapExample\Data\Item($item->id, $item->title, $item->complete);
            },
            $json->items
        );
        $list->addItems($children);

        return $list;
    }

    public function save(\NapExample\Data\TodoList $list)
    {
        $index = $this->getTodoListIndex($list->getId());
        if($index !== null) {
            $this->data->{'todo-lists'}[$index] = $list->jsonSerialize();
        }
        else {
            $this->data->{'todo-lists'} =array_merge(
                array_values($this->data->{'todo-lists'}),
                array($list->jsonSerialize())
            );
        }

        $this->writeDataBackToFile();
    }

    private function getTodoListIndex($id)
    {
        $i = 0;
        foreach($this->data->{'todo-lists'} as $list)
        {
            if($list->id === $id) {
                return $i;
            }

            $i++;
        }

        return null;
    }

    private function writeDataBackToFile()
    {
        $h = fopen($this->dataPath, "w+");
        fwrite($h, json_encode($this->data, JSON_PRETTY_PRINT));
        fclose($h);
    }
}