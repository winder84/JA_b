<?php
/**
 * Created by JetBrains PhpStorm.
 * User: winder
 * Date: 10.02.13
 * Time: 11:34
 * To change this template use File | Settings | File Templates.
 */
namespace Auto\Model;

class Auto
{
	public $id;
	public $cat_id;
	public $subcat_id;
	public $title;
	public $description;
	public $image;
	public $is_on_main;
	public $on_main_image;

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
		$this->cat_id = (isset($data['cat_id'])) ? $data['cat_id'] : null;
		$this->subcat_id = (isset($data['subcat_id'])) ? $data['subcat_id'] : null;
		$this->title  = (isset($data['title'])) ? $data['title'] : null;
		$this->description  = (isset($data['description'])) ? $data['description'] : null;
		$this->image  = (isset($data['image'])) ? $data['image'] : null;
		$this->is_on_main  = (isset($data['is_on_main'])) ? $data['is_on_main'] : null;
		$this->on_main_image  = (isset($data['on_main_image'])) ? $data['on_main_image'] : null;
	}
}