<?php
namespace NapExample\Controllers;

use Nap\Metadata\Annotations as Nap;
use Nap\Response\ActionResult;
use Nap\Response\Result\Data;
use Nap\Response\Result\HTTP\NotFound;
use Nap\Response\Result\HTTP\OK;
use NapExample\Data\TodoList;
use NapExample\Data\TodoListsRepository;

class TodoListsController implements \Nap\Controller\NapControllerInterface
{
    /** @var \NapExample\Data\TodoListsRepository */
    private $todoListsRepository;

    public function __construct()
    {
        $this->todoListsRepository = new TodoListsRepository(DATA_PATH);
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        $lists = $this->todoListsRepository->getAll();

        $output = array_map(
            function(TodoList $list) {
                return array(
                    "id" => $list->getId(),
                    "name" => $list->getName()
                );
            },
            $lists
        );

        return new ActionResult(new OK(), new Data($output));
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function get(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        $id = $params["TodoLists/id"];
        $list = $this->todoListsRepository->getTodoList($id);

        if($list != null)
        {
            return new ActionResult(new OK(), new Data($list));
        }
        else
        {
            return new ActionResult(new NotFound(), new Data(null));
        }

    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function post(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        // TODO: Implement post() method.
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function put(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        // TODO: Implement put() method.
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function delete(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function options(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        // TODO: Implement options() method.
    }
}