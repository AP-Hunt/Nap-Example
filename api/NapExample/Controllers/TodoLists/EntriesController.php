<?php
namespace NapExample\Controllers\TodoLists;

use Nap\Metadata\Annotations as Nap;
use Nap\Controller\NapControllerInterface;
use Nap\Response\ActionResult;
use Nap\Response\Result\Data;
use Nap\Response\Result\HTTP\BadRequest;
use Nap\Response\Result\HTTP\NotFound;
use Nap\Response\Result\HTTP\OK;
use NapExample\Data\TodoListsRepository;

class EntriesController implements NapControllerInterface
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
        // TODO: Implement index() method.
    }

    /**
     * @Nap\Accept({"application/json"})
     * @Nap\DefaultMime("application/json")
     */
    public function get(\Symfony\Component\HttpFoundation\Request $request, array $params)
    {
        // TODO: Implement get() method.
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
        $todoId = $params["TodoLists/id"];
        $entryId = $params["Entries/id"];
        $body = array();
        parse_str($request->getContent(), $body);

        if(!isset($body["complete"]))
        {
            header("HTTP 400 Bad Request");
            return new ActionResult(new BadRequest(), new Data(null));
        }

        $isComplete = (strtolower($body["complete"]) == "true");
        $list = $this->todoListsRepository->getTodoList($todoId);
        $item = $list->getItem($entryId);

        if($item === null) {
            return new ActionResult(new NotFound(), new Data(null));
        }

        $item->setIsDone($isComplete);
        $this->todoListsRepository->save($list);

        return new ActionResult(new OK(), new Data($item));

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