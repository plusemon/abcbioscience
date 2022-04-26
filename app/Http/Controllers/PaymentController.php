<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{

	protected
		$config = [
			"tokenURL" => "https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/grant",
			"createURL" => "https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/create",
			"executeURL" => "https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute/",

			"app_key" => "5tunt4masn6pv2hnvte1sb5n3j",
			"app_secret" => "1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka",

			"username" => "sandboxTestUser",
			"password" => "hWD@8vtzw0",
		];

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
		$id_token = $request->get('id_token');

		$request_data = array(
			'amount' => 100,
			'currency' => 'BDT',
			'intent' => 'sale',
			'merchantInvoiceNumber' => rand()
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

		$response = curl_exec($url);
		curl_close($url);

		return json_decode($response, true);
	}
}
