<?php

namespace Modules\Backend\Controllers;

class NewsController extends ControllerBase
{
	public function index()
	{
		$this->assets
			->addCss('css/bootstrap.min.css')
			->addCss('css/sticky-footer-navbar.css');
	}
    public function indexAction()
    {

    }
    public function showAction(){
    	
    }
}