<?php

namespace Modules\Backend\Controllers;

use Modules\Backend\Models;
use Modules\Backend\Models\News as News;
class NewsController extends ControllerBase
{
	public function index()
	{
	}
    public function indexAction()
    {
    	$news = new News;
    	var_dump($news);
    }
    public function showAction(){
    	
    }
}