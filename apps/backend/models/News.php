<?php
namespace Modules\Backend\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class News extends Model
{
    public function initialize()
    {
        $this->setSource("ps_news");
    }
}