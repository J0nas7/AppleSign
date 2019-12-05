<?php
class Utilities {

  // Construct link
  public function makeLink($array) {
      $string = "";
      if (is_array($array)) {
          $string .= (isset($array['page']) ? "/".$array['page'] : "");
          $string .= (isset($array['view']) ? "/".$array['view'] : "");
          $string .= (isset($array['show']) ? "/".$array['show'] : "");
          $string .= (isset($array['mode']) ? "/".$array['mode'] : "");
          if (isset($array['extra'])) {
              $string .= "/?";
              foreach ($array['extra'] AS $key => $value) {
                  $string .= $key."=".$value."&";
              }
              $string = rtrim($string, "&");
          }
      }
      return $string;
  }

  // Redirect browser using header or script function
  public function redirect($location, $script = false) {
  	if (!$script) {
  		header("Location: ".str_replace("&amp;", "&", $location));
  		exit;
  	} else {
  		echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
  		exit;
  	}
  }

  // Clean URL Function, prevents entities in server globals
  public function cleanurl($url) {
  	$bad_entities = array("&", "\"", "'", '\"', "\'", "<", ">", "(", ")", "*");
  	$safe_entities = array("&amp;", "", "", "", "", "", "", "", "", "");
  	$url = str_replace($bad_entities, $safe_entities, $url);
  	return $url;
  }

  // Generate Random Password
  public function generatePassword($length = 8) {
      $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $count = mb_strlen($chars);
      for ($i = 0, $result = ''; $i < $length; $i++) {
          $index = rand(0, $count - 1);
          $result .= mb_substr($chars, $index, 1);
      }
      return $result;
  }

  public function sendMail($subject, $to, $content, $Button = "") {
  	$headers = "From: Sorom <hej@sorom.dk>\r\n";
  	$headers .= "Reply-To: hej@sorom.dk\r\n";
  	$headers .= "MIME-Version: 1.0\r\n";
  	$headers .= "Content-Type: text/html; charset=utf-8\r\n";

  	$imgSrc = "https://dotweb.nu/app/control/template/medie/images/topmenu-logo.png";
  	$imgDesc = $imgTitle = "Sorom Logo";

  	$message = '<!DOCTYPE HTML>'.
  	'<head>'.
  		'<meta http-equiv="content-type" content="text/html">'.
  		'<title>'.$subject.'</title>'.
  	'</head>'.
  	'<body style="background-color: #F2F2F2;">'.
  		'<div id="header" style="width: 50%;height: auto;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: #3A4248;font-family: Verdana,sans-serif;">'.
  			'<img width="33" height="31" style="border-width:0" src="'.$imgSrc.'" alt="'.$imgDesc.'" title="'.$imgTitle.'">'.
  			'<br><span style="font-size: 30px;font-family: Verdana;display: block;margin-top: 10px;">Sorom</span>'.
  		'</div>'.

  		'<div id="outer" style="width: 50%;padding: 10px;margin: 0 auto;background-color: #fff;">'.
  			'<div id="inner" style="width: 90%;margin: 0 auto;font-family: Verdana,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;">'.
  				'<span style="float: left;font-family: Helvetica !important;font-weight: bold;font-size: 30px;color: #3A87AD;margin: 10px 0 20px 0;">'.$subject.'</span><br>'.
  				'<span style="float: left;clear: both;font-size: 15px;color: #606060;">'.$content.'</span>';
  				if ($Button) {
  					foreach ($Button AS $Link => $Text) {
  						$message .= '<a href="'.$Link.'" style="font-size: 15px;color: #fff;background-color: #4D6783;width: auto;height: auto;margin: 10px 0;padding: 8px;text-decoration: none;text-align: center;display: block;float: left;clear: both;">'.$Text.'</a>';
  					}
  				}

  				$message .= '<span style="float: left;clear: both;font-size: 15px;">'.
  					'<br><br>De bedste hilsner,<br>Sorom Webanalyse<br><br>'.
  					'Ps. Husk at tilføje hej@sorom.dk til dit adressekartotek. Så er du sikker på at få alle vigtige mails fra os, og undgår at de bliver fanget af dit spamfilter.'.
  				'</span>'.
  			'</div>'.
  		'<div style="clear: both;"></div>'.
  		'</div>'.

  		'<div id="footer" style="clear: both;width: 50%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena, sans-serif;background-color: #fff;font-size: 10px;">'.
  		   '<br>&copy; Sorom Webanalyse'.
  		   '<br>Alle rettigheder forbeholdes'.
  		'</div>'.
  	'</body>';

  	mail($to, $subject, $message, $headers);
  }

  function pre($array){
    echo '<pre>';
      print_r($array);
    echo  '</pre>';
  }

}
?>