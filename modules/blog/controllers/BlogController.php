<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 28/12/16
 * Time: 11:18
 */
namespace Modules\Blog\Controllers;

class BlogController extends \Vokuro\Controllers\ControllerBase
{
    public function initialize()
    {
        //$this->view->setTemplateBefore('public');
        //$this->view->setTemplateAfter("main");
    }

    public function indexAction()
    {

        //$this->view->user = \Vokuro\Models\Users::find(1);
        //$this->view->pick("index");
    }

    public function testAction()
    {
        $this->view->data = "oke";
        $this->view->pick("test");
    }
}