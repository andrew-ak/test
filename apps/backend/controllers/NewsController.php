<?php

namespace Modules\Backend\Controllers;

use Phalcon\Tag;
use Modules\Backend\Models;
use Modules\Backend\Forms\NewsForm as NewsForm;
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

    public function showAction()
    {

    }

    public function addNewsAction()
    {
        if ($this->request->isPost()) {

            $profile = new Profiles();

            $profile->assign(array(
                'name' => $this->request->getPost('name', 'striptags'),
                'active' => $this->request->getPost('active')
            ));

            if (!$profile->save()) {
                $this->flash->error($profile->getMessages());
            } else {
                $this->flash->success("Profile was created successfully");
            }

            Tag::resetInput();
        }

        $this->view->form = new NewsForm(null);
    }
}