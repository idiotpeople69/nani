<?php
error_reporting(0);
echo "\e[0;33m[!] Reff: \e[0m";
$reff = "7IG6VSTT";
echo "$reff\n";

//RANDOM NAME
login:
function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}

    function randomstr($length)
    {
        $str        = "";
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
          $rand = mt_rand(0, $max);
          $str .= $characters[$rand];
      }
      return $str;
  }

    function angkarand($panjang)
    {
        $karakter= '1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter)-1);
      $string .= $karakter{$pos};
        }
        return $string;
    }    

$nama = explode(" ", nama());
$nama1 = strtolower($nama[0]);
$nama2 = strtolower($nama[1]);
$rand = angkarand(5);
$namalengkap = "$nama1$nama2$rand";
$domain = "baomat.ml";
$email = "$namalengkap@$domain";
//$reff = "7IG6VSTT";

//CREATE EMAIL
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://generator.email/check_adres_validation3.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'usr='.$email,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));
$response = curl_exec($curl);
$httpcode1 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
$result = json_decode($response);
if($httpcode1 == 400){
  echo  "\e\33[31;1mGagal membuat email $email\n\n";
   }else{
     $httpcode1 == 200;
     echo  "\e\33[32;1mBerhasil membuat email $email\n";
 }

//REGISTER
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://vconomics.io/identity/accounts/register/4',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"userName":"'.$email.'","password":"Qazxsw123@","rePassword":"Qazxsw123@","fromReferralId":"'.$reff.'","fullName":"'.$nama1.' '.$nama2.'"}',
  CURLOPT_HTTPHEADER => array(
            'Accept: application/json, text/plain, */*',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: en-US,en;q=0.9,id;q=0.8,zh;q=0.7,ko;q=0.6,ja;q=0.5,zh-CN;q=0.4',
            'Content-Type: application/json',
            'Host: vconomics.io',
            'Origin: https://vconomics.io',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
            'X-CULTURE-CODE: EN',
            'X-VIA: 2',
  ),
));

$response = curl_exec($curl);
$httpcode2 = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if ($httpcode2 == 200) {
  $result1 = json_decode($response);
  if ($result1->success=="true"){
    $token = $result1->data->token;
    $pesan = $result1->messageCode;
    echo  "\e\33[32;1mBerhasil membuat akun $email\n";
    echo "\e[0;33m[!]\e[0m STATUS  : \e[0;32m$pesan\e[0m\n";
    echo "\e[0;33m[!]\e[0m TOKEN   : \e[0;32m$token\e[0m\n";
    sleep(3);


    echo "\e[0;33m[!]\e[0m OTP     : ";
    
    for ($i=0; $i < 15; $i++) { 

      //CEK EMAIL
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://generator.email/inbox3',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
                'cookie: surl='.$domain.'/'.$namalengkap
      ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      $otp=explode('</p>',explode('<p style="color: #fa7800; font-weight: bold; text-align: center; font-size: 40px">',$response)[1])[0];
    
      if ($otp==null){
        continue;
      }else{
        echo "\e[0;32m$otp\e[0m\n";
        break;
      }
    };

    //INPUT OTP
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://vconomics.io/identity/tokens/verify-otp',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"validateToken":"'.$token.'","otp":"'.$otp.'","otpType":1}',
    CURLOPT_HTTPHEADER => array(
            'Accept application/json, text/plain, */*',
            'Accept-Encoding: gzip, deflate, br',
            'Accept-Language: en-US,en;q=0.9,id;q=0.8,zh;q=0.7,ko;q=0.6,ja;q=0.5,zh-CN;q=0.4',
            'Content-Type: application/json',
            'Host: vconomics.io',
            'Origin: https://vconomics.io',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
            'X-CULTURE-CODE: EN',
            'X-VIA: 2',
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response);
    if ($result->success=="true"){
      $pesan2 = $result->messageCode;
      echo "\e[0;33m[!]\e[0m STATUS  : \e[0;32m$pesan2\e[0m\n";
      goto login;
    }else{
      echo  "\e\33[31;1mGAGAL MEMASUKKAN OTP\n";
      goto login;
    }
  }else{
    echo  "\e\33[31;1mGagal Melakukan registrasi\n";
    goto login;
  }
} else {
  echo  "\e\33[31;1mGagal Melakukan registrasi\n";
  goto login;
}
