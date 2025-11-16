<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentGatewayService
{
    protected $config;

    public function __construct()
    {
        $this->config = [
            'vnpay' => [
                'enabled' => env('VNPAY_ENABLED', false),
                'tmn_code' => env('VNPAY_TMN_CODE'),
                'hash_secret' => env('VNPAY_HASH_SECRET'),
                'url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
                'return_url' => env('VNPAY_RETURN_URL', url('/payments/vnpay/return')),
            ],
            'momo' => [
                'enabled' => env('MOMO_ENABLED', false),
                'partner_code' => env('MOMO_PARTNER_CODE'),
                'access_key' => env('MOMO_ACCESS_KEY'),
                'secret_key' => env('MOMO_SECRET_KEY'),
                'url' => env('MOMO_URL', 'https://test-payment.momo.vn/v2/gateway/api/create'),
                'return_url' => env('MOMO_RETURN_URL', url('/payments/momo/return')),
            ],
            'stripe' => [
                'enabled' => env('STRIPE_ENABLED', false),
                'public_key' => env('STRIPE_PUBLIC_KEY'),
                'secret_key' => env('STRIPE_SECRET_KEY'),
                'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
            ],
        ];
    }

    /**
     * Create VNPay payment URL
     */
    public function createVNPayPayment($orderCode, $amount, $orderInfo = '')
    {
        if (!$this->config['vnpay']['enabled']) {
            throw new \Exception('VNPay payment gateway is not enabled.');
        }

        $vnp_TmnCode = $this->config['vnpay']['tmn_code'];
        $vnp_HashSecret = $this->config['vnpay']['hash_secret'];
        $vnp_Url = $this->config['vnpay']['url'];
        $vnp_Returnurl = $this->config['vnpay']['return_url'];

        $vnp_TxnRef = $orderCode;
        $vnp_OrderInfo = $orderInfo ?: "Thanh toan don hang: {$orderCode}";
        $vnp_OrderType = 'other';
        $vnp_Amount = $amount * 100; // VNPay expects amount in cents
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return $vnp_Url;
    }

    /**
     * Create MoMo payment URL
     */
    public function createMoMoPayment($orderCode, $amount, $orderInfo = '')
    {
        if (!$this->config['momo']['enabled']) {
            throw new \Exception('MoMo payment gateway is not enabled.');
        }

        $partnerCode = $this->config['momo']['partner_code'];
        $accessKey = $this->config['momo']['access_key'];
        $secretKey = $this->config['momo']['secret_key'];
        $url = $this->config['momo']['url'];
        $returnUrl = $this->config['momo']['return_url'];

        $requestId = time() . '';
        $extraData = '';

        $rawHash = "accessKey={$accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$returnUrl}&orderId={$orderCode}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$returnUrl}&requestId={$requestId}&requestType=captureWallet";
        $signature = hash_hmac('sha256', $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => 'Karate TMA',
            'storeId' => 'MomoTestStore',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderCode,
            'orderInfo' => $orderInfo ?: "Thanh toan don hang: {$orderCode}",
            'redirectUrl' => $returnUrl,
            'ipnUrl' => $returnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => 'captureWallet',
            'signature' => $signature,
        ];

        try {
            $response = Http::post($url, $data);
            
            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['payUrl'])) {
                    return $result['payUrl'];
                }
            }

            Log::error('MoMo Payment Error', ['response' => $response->json()]);
            throw new \Exception('Failed to create MoMo payment.');
        } catch (\Exception $e) {
            Log::error('MoMo Payment Exception', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Create Stripe payment intent
     */
    public function createStripePayment($orderCode, $amount, $currency = 'usd')
    {
        if (!$this->config['stripe']['enabled']) {
            throw new \Exception('Stripe payment gateway is not enabled.');
        }

        \Stripe\Stripe::setApiKey($this->config['stripe']['secret_key']);

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount * 100, // Stripe expects amount in cents
                'currency' => $currency,
                'metadata' => [
                    'order_code' => $orderCode,
                ],
            ]);

            return [
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ];
        } catch (\Exception $e) {
            Log::error('Stripe Payment Error', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Verify VNPay callback
     */
    public function verifyVNPayCallback($data)
    {
        $vnp_HashSecret = $this->config['vnpay']['hash_secret'];
        $vnp_SecureHash = $data['vnp_SecureHash'] ?? '';
        unset($data['vnp_SecureHash']);

        ksort($data);
        $hashdata = '';
        foreach ($data as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashdata = rtrim($hashdata, '&');

        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        return $secureHash === $vnp_SecureHash;
    }
}

