<?php
/*
* API by TEXTLOCAL - Code by Đại Nguyễn
* Facebook: http://facebook.com/deekey.hn
* Email: daikupj@gmail.com
* Rất vui nếu được Donate :D
*/
class Connect_Textlocal
{
	const REQUEST_URL = 'http://api.txtlocal.com/';
	const REQUEST_TIMEOUT = 8;
	const REQUEST_HANDLER = 'curl';

	private $username;
	private $hash;
	private $apiKey;

	private $errorReporting = false;

	public $errors = array();
	public $warnings = array();

	public $lastRequest = array();

	function __construct($username, $hash, $apiKey = false)
	{
		$this->username = $username;
		$this->hash = $hash;
		if ($apiKey) {
			$this->apiKey = $apiKey;
		}

	}

	private function _sendRequest($command, $params = array())
	{
		if ($this->apiKey && !empty($this->apiKey)) {
			$params['apiKey'] = $this->apiKey;

		} else {
			$params['hash'] = $this->hash;
		}
		
		$params['username'] = $this->username;

		$this->lastRequest = $params;

		if (self::REQUEST_HANDLER == 'curl')
			$rawResponse = $this->_sendRequestCurl($command, $params);
		else throw new Exception('Invalid request handler.');

		$result = json_decode($rawResponse);
		if (isset($result->errors)) {
			if (count($result->errors) > 0) {
				foreach ($result->errors as $error) {
					switch ($error->code) {
						default:
							throw new Exception($error->message);
					}
				}
			}
		}

		return $result;
	}

	private function _sendRequestCurl($command, $params)
	{

		$url = self::REQUEST_URL . $command . '/';

		// Initialize handle
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_POST           => true,
			CURLOPT_POSTFIELDS     => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_TIMEOUT        => self::REQUEST_TIMEOUT
		));

		$rawResponse = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		curl_close($ch);

		if ($rawResponse === false) {
			throw new Exception('Failed to connect to the Textlocal service: ' . $error);
		} elseif ($httpCode != 200) {
			throw new Exception('Bad response from the Textlocal service: HTTP code ' . $httpCode);
		}

		return $rawResponse;
	}


	private function _sendRequestFopen($command, $params)
	{
		throw new Exception('Unsupported transfer method');
	}


	public function getLastRequest()
	{
		return $this->lastRequest;
	}


	public function sendSms($numbers, $message, $sender, $sched = null, $test = false, $receiptURL = null, $custom = null, $optouts = false, $simpleReplyService = false)
	{

		if (!is_array($numbers))
			throw new Exception('Invalid $numbers format. Must be an array');
		if (empty($message))
			throw new Exception('Empty message');
		if (empty($sender))
			throw new Exception('Empty sender name');
		if (!is_null($sched) && !is_numeric($sched))
			throw new Exception('Invalid date format. Use numeric epoch format');

		$params = array(
			'message'       => urlencode($message),
			'numbers'       => implode(',', $numbers),
			'sender'        => urlencode($sender),
			'schedule_time' => $sched,
			'test'          => $test,
			'receipt_url'   => $receiptURL,
			'custom'        => $custom,
			'optouts'       => $optouts,
			'simple_reply'  => $simpleReplyService
		);

		return $this->_sendRequest('send', $params);
	}


	public function transferCredits($user, $credits)
	{

		if (!is_numeric($credits))
			throw new Exception('Invalid credits format');
		if (!is_numeric($user))
			throw new Exception('Invalid user');
		if (empty($user))
			throw new Exception('No user specified');
		if (empty($credits))
			throw new Exception('No credits specified');

		if (is_int($user)) {
			$params = array(
				'user_id' => urlencode($user),
				'credits' => $credits
			);
		} else {
			$params = array(
				'user_email' => urlencode($user),
				'credits'    => $credits
			);
		}

		return $this->_sendRequest('transfer_credits', $params);
	}


	public function getBalance()
	{
		$result = $this->_sendRequest('balance');
		return array('sms' => $result->balance->sms, 'mms' => $result->balance->mms);
	}

	
}

;


if (!function_exists('json_encode')) {
	function json_encode($a = false)
	{
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a)) {
			if (is_float($a)) {
				return floatval(str_replace(",", ".", strval($a)));
			}

			if (is_string($a)) {
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			} else
				return $a;
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
			if (key($a) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList) {
			foreach ($a as $v) $result[] = json_encode($v);
			return '[' . join(',', $result) . ']';
		} else {
			foreach ($a as $k => $v) $result[] = json_encode($k) . ':' . json_encode($v);
			return '{' . join(',', $result) . '}';
		}
	}
}


