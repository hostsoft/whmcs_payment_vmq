<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function wanyivmq_MetaData()
{
    return array(
        'DisplayName' => 'V免签(支付宝,微信)',
        'APIVersion' => '1.14',
        'DisableLocalCreditCardInput' => true,
        'gatewayType' => 'QRCODE',
        'TokenisedStorage' => false,
    );
}


function wanyivmq_config()
{
    return array(
        'FriendlyName' => array(
            'Type' => 'System',
            'Value' => '扫码支付(支付宝,微信)',
        ),
        'AppURL' => array(
            'FriendlyName' => '接口地址',
            'Type' => 'text',
            'Size' => '100',
            'Default' => '',
            'Description' => 'V免签应用安装地址,结尾勿带斜杠',
        ),
        'AppKEY' => array(
            'FriendlyName' => '应用密匙',
            'Type' => 'password',
            'Size' => '100',
            'Default' => '',
            'Description' => 'V免签后台显示的通讯密匙!',
        ),
        'AppNotify' => array(
            'FriendlyName' => '异步返回',
            'Type' => 'readonly',
            'Size' => '1000',
            'Value' => "",
            'Description' => WHMCS\Config\Setting::getValue("SystemURL").'/modules/gateways/callback/wanyivmq.php'." V免签后台输入这个",
            'Default' => '',
        ),
        'AppReturn' => array(
            'FriendlyName' => '同步返回',
            'Type' => 'readonly',
            'Size' => '1000',
            'Value' => "",
            'Description' => WHMCS\Config\Setting::getValue("SystemURL").'/clientarea.php'." V免签后台输入这个",
            'Default' => '',
        ),
    );
}

function wanyivmq_link($params)
{
    $appurl = $params['AppURL'];
    $appkey = $params['AppKEY'];
    $invoiceid = $params['invoiceid'];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['currency']; # Currency Code
    $payID1="1".time();
    $payID2="2".time();
    $root_url = "{$appurl}/createOrder?";
    $array_agv1 = "payId={$payID1}&price={$amount}&param={$invoiceid}";
    $array_agv2 = "payId={$payID2}&price={$amount}&param={$invoiceid}";
    $sign1 = md5($payID1.$invoiceid."1".$amount.$appkey);
    $sign2 = md5($payID2.$invoiceid."2".$amount.$appkey);
    $weixin_url = "{$array_agv1}&type=1&sign={$sign1}&isHtml=1";
    $alipay_url = "{$array_agv2}&type=2&sign={$sign2}&isHtml=1";
    $htmlOutput  = "<a href=\"{$root_url}{$alipay_url}\" target=\"_blank\" class=\"btn btn-primary btn-sm mr-3\"> 支付宝扫码 </a>";
    $htmlOutput .= "";
    $htmlOutput .= "<a href=\"{$root_url}{$weixin_url}\" target=\"_blank\" class=\"btn btn-success btn-sm\"> 微信扫码 </a>";
    return $htmlOutput;
}

