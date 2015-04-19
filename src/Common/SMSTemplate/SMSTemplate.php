<?php

namespace common\SMSTemplate\models;

use Illuminate\Database\Eloquent\Model;

/**
 * 下发短信时的内容模版
 *
 * @author Jejim
 *        
 */
class SMSTemplate extends Model {
	
	/**
	 *
	 * @var string
	 */
	protected $table = 'SMSTemplate';
	
	/**
	 *
	 * @var string
	 */
	protected $primaryKey = 'name';
	public $incrementing = false;
	
	/**
	 * 名称，唯一标志模版
	 *
	 * @var string
	 */
	protected $name;
	
	/**
	 * 模版内容
	 *
	 * @var string
	 */
	protected $template;
}