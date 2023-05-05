<?php
// Require libraries needed for gateway module functions.
require_once __DIR__ . '/../../../init.php';
App::load_function('gateway');
App::load_function('invoice');

// Detect module name from filename.
$gatewayModuleName = basename(__FILE__, '.php');

// Fetch gateway configuration parameters.
$gatewayParams = getGatewayVariables($gatewayModuleName);

// Die if module is not active.
if (!$gatewayParams['type']) {
    die("Module Not Activated");
}

logTransaction($gatewayParams['name'], $_REQUEST, 'V免签');

// 接收返回参数
$appkey = $gatewayParams['AppKEY'];
$payId = $_REQUEST['payId']; //商户订单号
$param = trim($_REQUEST['param']); //创建订单的时候传入的参数
$type = $_REQUEST['type']; //支付方式 ：微信支付为1 支付宝支付为2
$price = $_REQUEST['price']; //订单金额
$reallyPrice = $_REQUEST['reallyPrice'];//实际支付金额
$sign = $_REQUEST['sign'];//校验签名，计算方式 = md5(payId + param + type + price + reallyPrice + 通讯密钥)
// 开始校验签名
$_sign =  md5($payId . $param . $type . $price . $reallyPrice . $appkey);
if ($_sign != $sign) {
    echo "error_sign";//sign校验不通过
    exit();
}

// 处理币种转换
if ($gatewayParams["convertto"]) {
    $data = WHMCS\Database\Capsule::table("tblinvoices")->where("id", $param)->first(array("userid", "total"));
    $userid = $data->userid;
    $total = $data->total;
    $currency = getCurrency($userid);
    $amount = convertCurrency($reallyPrice, $gatewayParams["convertto"], $currency["id"]);
    if ($total < $amount + 1 && $amount - 1 < $total) {
        $amount = $total;
    }
} else {
    $amount = $reallyPrice;
}

// 处理业务
$invoiceId = checkCbInvoiceID($param, $gatewayParams['name']);
//$invoice = WHMCS\Billing\Invoice::find($invoiceId);
//$userCurrency = getCurrency($invoice->clientId);
////var_dump($userCurrency);
//if($userCurrency['Code'] != $CurrencyCode ) {
//    $paymentCurrencyID = WHMCS\Database\Capsule::table("tblcurrencies")->where("code", $CurrencyCode)->value("id");
//    $currentCurrencyID = WHMCS\Database\Capsule::table("tblcurrencies")->where("code", $userCurrency['code'])->value("id");
//    $amount = convertCurrency($price, $paymentCurrencyID, $currentCurrencyID);
//}
$priceAmount = $amount;
$paymentAmount = $reallyPrice;
$transactionId = $payId;
addInvoicePayment(
    $invoiceId,
    $transactionId,
    $priceAmount,
    null,
    $gatewayModuleName
);
logTransaction($gatewayParams['name'], $_REQUEST, "Invoice {$invoiceId} has been paid. Amount received: {$paymentAmount}");

// 返回结果
echo "success";
