<?php

namespace util\SMS;

use Illuminate\Database\Eloquent\Model;

/**
 */
class SMSSendRecord extends Model {
	
	/**
	 * 表名
	 *
	 * @var string
	 */
	protected $table = 'SMSSendRecord';
	
	/**
	 * 本消息的状态。
	 *
	 * @var integer
	 */
	const STATUS_SEND_SUC = 1; // 发送成功
	const STATUS_SEND_FAILED = 2; // 发送失败
	const STATUS_RECEIVED_SUC = 3; // 接收成功
	const STATUS_RECEIVED_FAILED = 4; // 接收失败
	
	/**
	 *
	 * @Column(type="integer",options={"comment":""})
	 *
	 * @var integer @Id
	 */
	protected $id;
	
	/**
	 * 手机号，可以是多个，用英文逗号分开
	 *
	 * @var string
	 */
	protected $phonenum;
	
	/**
	 * @length:512
	 *
	 * @var string @Column(type="string",length=512,options={"comment":""})
	 */
	protected $content;
	
	/**
	 * 网关返回的消息id
	 *
	 * @var string
	 */
	protected $msgId;
	
	/**
	 *
	 * @var DateTime @Column(type="datetime",options={"comment":""})
	 */
	protected $receivedTime;
	
	/**
	 * 网管的错误码
	 *
	 * @var strin
	 */
	protected $gatewayError;
	
	/**
	 * 1：发送成功；2：发送失败；3：接收成功；4：接收失败
	 *
	 * @var integer
	 *      @Column(type="integer",options={"comment":"1：发送成功；2：发送失败；3：接收成功；4：接收失败"})
	 */
	protected $status;
}
	
