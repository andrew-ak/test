<?php
/**
 * Created by PhpStorm.
 * User: Andrew Kuzmenko
 * Date: 12.07.2016
 * Time: 14:11
 */
namespace Modules\Backend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Textarea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

class NewsForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id');
        }
        $this->add($id);
        $this->add(new Select('active', array(
            '1' => 'Yes',
            '0' => 'No',
        )));

        //$this->add();

        $name = new Text('title', array(
            'placeholder' => 'Title news'
        ));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'The title is required'
            ))
        ));
        $this->add($name);


        $this->add(new Textarea('content', array(
            'placeholder' => 'Content news'
        )));
    }
}
