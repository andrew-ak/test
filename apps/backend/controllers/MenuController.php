<?php
namespace Modules\Backend\Controllers;

use Modules\Backend\Models;
class MenuController extends ControllerBase
{
	public function indexAction()
	{
		$this->view->setVar("active", "news");
	}
}