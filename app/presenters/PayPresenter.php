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

	public function renderDefault($amount = 250, $message = '')
	{
		if(!isset($this->parameters->params['qr']['account']) ||
	       !isset($this->parameters->params['qr']['code'])) {
			$this->error('This service is not configured!');
		}
		$image = Image::fromFile(
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
				$this->parameters->params['qr']['account'],
				$this->parameters->params['qr']['code'],
				$amount,
				$message
			)
		);
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