<?php

namespace Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;

use Modules\Backend\Models;

class ControllerBase extends Controller
{
	public function initialize()
	{
        $this->tag->appendTitle('DDoor:Admin| ');
        $this->view->setTemplateAfter('admin');
	}
	public function index()
	{
	}
	protected function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);
        return $this->dispatcher->forward([
            'controller' => $uriParts[0],
            'action' => $uriParts[1],
            'params' => $params
        ]);
    }
}
