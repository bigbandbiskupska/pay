<?php

namespace App\Presenters;

use Nette\Utils\Image;
use Tulinkry\Services\ParameterService;

class PayPresenter extends BasePresenter
{

    /**
     * @var ParameterService
     * @inject
     */
    public $parameters;

	public function renderAll($ks = null, $vs = null, $ss = null, $amount, $message = '')
	{
		if(!isset($this->parameters->params['qr']['account']) ||
	       !isset($this->parameters->params['qr']['code'])) {
			$this->error('This service is not configured!');
		}
		//$ks = (isset($this->parameters->params['qr']['ks']) ? $this->parameters->params['qr']['ks'] : $ks);
		//$vs = (isset($this->parameters->params['qr']['vs']) ? $this->parameters->params['qr']['vs'] : $vs);
		//$ss = (isset($this->parameters->params['qr']['ss']) ? $this->parameters->params['qr']['ss'] : $vs);
/*
		$values = [
			'compress' => false,
			'size' => 250,
			'accountNumber' => urlencode($this->parameters->params['qr']['account']),
			'bankCode' => urlencode($this->parameters->params['qr']['code']),
			'amount' => urlencode($amount),
			'currency' => 'CZK',
			'branding' => false,
			'message' => urlencode($message),
			 'ks' => $ks,
			 'vs' => $ks,
			 'ss' => $ks,
		];
*/
		$query = sprintf(
			"https://api.paylibo.com/paylibo/generator/czech/image?" .
			"compress=false" .
			"&size=250" .
			"&accountNumber=%s" .
			"&bankCode=%s" .
			"&amount=%s" .
			"&currency=CZK" .
			"&branding=false" .
			"&message=%s" .
			"%s" . // ks
			"%s" . // vs
			"%s", // ss
			urlencode($this->parameters->params['qr']['account']),
			urlencode($this->parameters->params['qr']['code']),
			urlencode($amount),
			urlencode($message),
			$ks !== null ? '&ks=' . $ks : '',
			$vs !== null ? '&vs=' . $vs : '',
			$ss !== null ? '&ss=' . $ss : ''
		);

		//echo $query;

		$image = Image::fromFile($query);
		$image->send();
	}
}


/*


<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

$message = $_GET['message'] ? $_GET['message'] : "";
$amount = $_GET['amount'];
header('Content-Type: image/png');
echo file_get_contents(
	sprintf(
		"https://api.paylibo.com/paylibo/generator/czech/image?" . 
		"compress=false" .
		"&size=250" .
		"&accountNumber=%s" .
		"&bankCode=%s" .
		"&amount=%s" .
		"&currency=CZK" .
		"&branding=false" .
		"&message=%s",
		ACCOUNT_NUMBER,
		BANK_CODE,
		$amount,
		$message
	)
);

 */