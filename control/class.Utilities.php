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

  function pre($array){
    echo '<pre>';
      print_r($array);
    echo  '</pre>';
  }

}
?>