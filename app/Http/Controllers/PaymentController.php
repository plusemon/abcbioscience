<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PaymentHistory;

class PaymentController extends Controller
{

	protected $config;

	public function __construct()
	{
		$this->config = [
			"tokenURL" =>
			env('BKASH_SANDBOX') ?
				"https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/grant" :
				"https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant",

			"createURL" =>
			env('BKASH_SANDBOX') ?
				"https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/create" :
				"https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create",

			"executeURL" =>
			env('BKASH_SANDBOX') ?
				"https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute/" :
				"https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/",

			"app_key" => env('BKASH_APP_KEY'),
			"app_secret" => env('BKASH_APP_SECRET'),

			"username" => env('BKASH_USERNAME'),
			"password" => env('BKASH_PASSWORD'),
		];
	}

	public function grand_token()
	{
		$request_data  = [
			'app_key' => $this->config['app_key'],
			'app_secret' => $this->config['app_secret'],
		];

		$url = curl_init($this->config["tokenURL"]);
		$request_data_json = json_encode($request_data);
		$header = [
			'Content-Type:application/json',
			'password:' . $this->config["password"],
			'username:' . $this->config["username"]
		];

		curl_setopt($url, CURLOPT_HTTPHEADER, $header);
		curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
		curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		$response = curl_exec($url);
		curl_close($url);

		return json_decode($response, true);

		// return	$id_token = json_decode($response, true)['id_token'];
		// return $this->createpayment($id_token);
	}

	public function createpayment(Request $request)
	{
		$request->validate([
			'id_token' => ['required'],
			'invoice_no' => ['required', 'string'],
		]);

		$id_token = $request->get('id_token');
		$invoice_no = $request->get('invoice_no');

		$data = PaymentHistory::where('invoice_no', strval($invoice_no))->first();

		$request_data = array(
			'amount' => $data->amount,
			'currency' => 'BDT',
			'intent' => 'sale',
			'merchantInvoiceNumber' => $data->invoice_no
		);


		$url = curl_init($this->config['createURL']);
		$request_data_json = json_encode($request_data);
		$header = array(
			'Content-Type:application/json',
			'authorization:' . $id_token,
			'x-app-key:' . $this->config['app_key']
		);

		curl_setopt($url, CURLOPT_HTTPHEADER, $header);
		curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url, CURLOPT_POSTFIELDS, $request_data_json);
		curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

		$response = curl_exec($url);
		curl_close($url);

		return json_decode($response, true);
	}

	public function executepayment(Request $request)
	{
		$request->validate([
			'paymentID' => ['required'],
			'id_token' => ['required'],
		]);

		$paymentID = $request['paymentID'];
		$url = curl_init($this->config['executeURL'] . $paymentID);
		$header = array(
			'Content-Type:application/json',
			'authorization:' . $request->get('id_token'),
			'x-app-key:' . $this->config['app_key']
		);

		curl_setopt($url, CURLOPT_HTTPHEADER, $header);
		curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);

		$result = curl_exec($url);
		curl_close($url);

		$response = json_decode($result, true);

		if (isset($response['transactionStatus']) and $response['transactionStatus'] == 'Completed') {
			$this->successAction($response);
		}

		return $response;
	}

	public function successAction($response)
	{
		$invoice_no = $response['merchantInvoiceNumber'];
		$data =	PaymentHistory::where('invoice_no', strval($invoice_no))->first();

		$data->status = 1;
		return	$data->save();
	}
}
