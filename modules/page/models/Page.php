<?php
namespace Modules\Page\Models;
use \Phalcon\Mvc\Model\Behavior\Timestampable;
class Page extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
	*
	* @var varchar
	* @Column(type="varchar", length=10, nullable=false)
	*/
	
	public $content;
/**
	*
	* @var int
	* @Column(type="int", length=10, nullable=false)
	*/
	
	public $status;


}