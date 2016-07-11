<?php

namespace Modules\Backend\Controllers;

use Modules\Backend\Models;
use Modules\Backend\Models\News as News;
class NewsController extends ControllerBase
{
	public function initialize()
	{
        parent::initialize();
        $this->tag->appendTitle("News.");
	}
    public function indexAction()
    {
        $this->tag->appendTitle("Index.");
//    	$news = new News;
    	//var_dump($news);
        $this->view->news = News::find();
    }
    public function showAction(){
    	
    }
}