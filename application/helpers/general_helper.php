<?php

if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {

        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}

function firebase_notify($to,$titulo,$corpo,$redirect){
  define('API_ACCESS_KEY','AAAARo4DRBw:APA91bGkhowiZk12qklLCEtJYZ63xAWyKTN51ot1iTUhsjx6t7PYp7f-ayFAMHADoxbEXr7wEzdLtkUpm5sfBieLXwOzLNkwXOi5Eg4A_Vj9uz41UAYxKXjDLeLSxEG-vHUImVMhsLKb');
  $data = array("to" => $to, "notification" => array( "title" => $titulo, "body" => $corpo, "redirect_to" => $redirect));
  $data_string = json_encode($data);

  $headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
  $ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
  curl_setopt( $ch,CURLOPT_POST, true );
  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
  $result = curl_exec($ch);
  curl_close ($ch);
  return $result;
  }


function mes_numero($numero){
  $meses = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
  );
  return $meses[$numero];
}

function is_mobile(){
  require_once 'application/libraries/Mobile_Detect.php';
  $detect = new Mobile_Detect;
  return $detect->isMobile();
}

function usuario_logado($redirect = true){
  $ci = &get_instance();
  $ci->load->library('ion_auth');
  if (!$ci->ion_auth->logged_in()){
      if($redirect) {
          redirect('auth/login');
      } else {
          return false;
      }
  } else {
      return $ci->ion_auth->user()->row();
  }
}

 function chat_in($message,$time,$picture,$type){
   if($type == 2) {
     $message = '<audio controls><source src="/'.$message.'" type="audio/ogg">Your browser does not support the audio element.</audio>';
   }

   if($type == 3) {
     $onclick = "show('$message')";
     $message = '<img width="250px" heigth="250px" onclick="'.$onclick.'" src="/'.$message.'"</img>';
   }

   if($type == 4) {
     $nome = str_replace('uploads/','',$message);
     $message = '<a target="_blank" href="/'.$message.'">Download do arquivo : '.$nome.'</a>';
   }

  $template = '<div class="d-flex mb-3 flex-row-reverse">
    <img src="%picture%" alt="" class="avatar-sm rounded-circle mr-3">
    <div class="message " >

        <p class="m-0" >%message%</p>
        <div class="d-flex">
            <span class="text-small text-muted">%time%</span>
        </div>
    </div>
</div>';

$template = str_replace("%message%",$message,$template);
$template = str_replace("%picture%",$picture,$template);
$template = str_replace("%time%",$time,$template);
return $template;

}

 function chat_out($message,$time,$picture,$type){
   if($type == 2) {
     $message = '<audio controls><source src="/'.$message.'" type="audio/ogg">Your browser does not support the audio element.</audio>';
   }

   if($type == 3) {
     $onclick = "show('$message')";

     $message = '<img width="250px" heigth="250px" onclick="'.$onclick.'" src="/'.$message.'"</img>';
   }

   if($type == 4) {
     $message = '<a target="_blank" href="/'.$message.'">Download do arquivo : '.$message.'</a>';
   }


   $template = '<div class="d-flex mb-3 user">
    <img src="%picture%" alt="" class="avatar-sm rounded-circle ml-3">
       <div class="message " style="background-color:#4cdef6;text-align: right">
           <p class="m-0" style="color: white; text-shadow: 1px black;" >%message%</p>
           <div class="d-flex">
               <span class="text-small text-muted" style="color: white; text-shadow: 1px black;">%time%</span>
           </div>
       </div>

   </div>';
   $template = str_replace("%message%",$message,$template);
   $template = str_replace("%picture%",$picture,$template);
   $template = str_replace("%time%",$time,$template);
  return $template;
 }


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);       exit;
    }
}

if (!function_exists('encrypt')) {
function encrypt($mensagem){


  return $mensagem;
  return base64_encode($mensagem);
}}

if (!function_exists('decrypt')) {
function decrypt($mensagem, $a_chave_do_usuario = 'nicolebrasil'){
  return $mensagem;
return base64_decode($mensagem);
}}



if (!function_exists('curl')) {
  function curl($url='',$var='',$type,$autorization){
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($curl, CURLOPT_REFERER, "http://lbeelocal.com");
  if($var) {
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
  }
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $type);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  if($autorization) {
    $headers = array(
      'Content-type: application/xml',
      'Authorization: Bearer ' . $autorization,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  }
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($curl);
  curl_close($curl);
  return $result;
  }
}

if (!function_exists('curl_avancado')) {
  function curl_avancado($dados){

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $dados['url']);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  /*
  if(isset($dados['debug'])) {
    if($dados['debug']) {
      curl_setopt($curl, CURLOPT_VERBOSE, true);
      curl_setopt($curl, CURLOPT_STDERR, $verbose = fopen('php://temp', 'rw+'));
      curl_setopt($curl, CURLOPT_FILETIME, true);
    }
  }
  */
  if(isset($dados['parametros_post'])) {
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $dados['parametros_post']);
  }


  if(isset($dados['tipo'])) {
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  } else {
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
  }



  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

  if(isset($dados['cabecalho'])) {
    curl_setopt($curl, CURLOPT_HTTPHEADER, $dados['cabecalho']);
  }

  if(isset($dados['retorno']) ) {
    if($dados['retorno'] == false) {
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
    }
  }


  $result = curl_exec($curl);


  /* if(isset($dados['debug'])) {
    dump( "Verbose information:\n", !rewind($verbose) . stream_get_contents($verbose) );
    dump(curl_getinfo($curl));
  }
  */

  curl_close($curl);



  if(isset($dados['tipo_retorno'])) {
    switch ($dados['tipo_retorno']) {
      case 'json' :
         return json_decode($result);
         break;
      case 'json_to_array' :
         return json_decode($result,true);
         break;
      default:
        return $result;
        break;
    }
  } else {
    return $result;
  }



 }
}


if (!function_exists('filter_data')) {
function filter_data($data){
    $data = strip_tags($data);
    $data = trim($data);
    return $data;
}
}

if (!function_exists('set_redirect')) {
function set_redirect($url){
    echo '<META http-equiv="refresh" content="5;URL='.$url.'"> ';
}
}


if (!function_exists('script_alert')) {
function script_alert($msg){
  echo '<script>alert("'.$msg.'");</script>';
}
}



if (!function_exists('discord_alert')) {

  function discord_alert($msg,$type = NULL){

    switch($type){
      case "alert":
        $color = '12716811';
        $title = '[ATENÇÃO] ALERTA VERMELHO';
       break;
      case "image":
        $color = '6799883';
        $title = 'IMG';
       break;
       case "payment":
         $color = '16764672';
         $title = 'Pagamento Iniciado';
        break;
        case "paymentaproved":
          $color = '65280';
          $title = 'Pagamento Aprovado';
         break;
      case "simple":
        $color = '12716888';
        $title = 'Log';
       break;
      case "bot_alert":
        $color = '14177041';
        $title = 'BOT ALERT';
       break;
      default:
        $color = '1127128';
        $title = 'Mensagem';
        break;
    }


    $msg = '{
     "embeds": [{
     	  "color": '.$color.',
         "footer": {
           "text": "MoriartyDEV doing awesomeness",
           "icon_url": "https://pre00.deviantart.net/39c0/th/pre/i/2014/014/4/d/3_jim_moriarty_by_nati_nio-d725ddj.jpg"
         },
         "description": "'.$msg.'",
         "title": "'.$title.'"
     }
     ]
     }';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://discordapp.com/api/webhooks/458499484389998597/tJ9oKOKSb4nBbPNTsJH7jvi4s_eVBmyNlu6mA2iw4lbVcb3jbvYhk_ci8LWQjXa5uOI7");
	 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$msg);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
  }



}

if (!function_exists('download')) {
  function download($file_source, $file_target) {
      $rh = fopen($file_source, 'rb');
      $wh = fopen($file_target, 'w+b');
      if (!$rh || !$wh) {
          return false;
      }

      while (!feof($rh)) {
          if (fwrite($wh, fread($rh, 4096)) === FALSE) {
              return false;
          }
          echo ' ';
          flush();
      }

      fclose($rh);
      fclose($wh);

      return true;
  }
}


if (!function_exists('containsWord')) {
function containsWord($str, $word){
    return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
}
}

if (!function_exists('customSearch')) {
  function customSearch($keyword, $arrayToSearch){
        foreach($arrayToSearch as $key => $arrayItem){
            if( stristr( $arrayItem, $keyword ) ){
                return $key;
            }
        }
    }
}


if (!function_exists('random')) {
    function random($length)
    {
       $string = "";
       $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       $size = strlen($chars);
       for ($i = 0; $i < $length; $i++) {
           $string .= $chars[rand(0, $size - 1)];
       }
       return $string;
    }
}


if (!function_exists('random_string')) {
function random_string($length)
{
   $string = "";
   $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $size = strlen($chars);
   for ($i = 0; $i < $length; $i++) {
       $string .= $chars[rand(0, $size - 1)];
   }
   return $string;
}
}


if (!function_exists('textile_sanitize')) {
  function textile_sanitize($string){
      $whitelist = '/[^a-zA-Z0-9Ð°-ÑÐ-Ð¯Ã©Ã¼Ñ€Ñ‚Ñ…Ñ†Ñ‡ÑˆÑ‰ÑŠÑ‹ÑÑŽÑŒÐÑƒÑ„Ò \.\*\+\\n|#;:!"%@{} _-]/';
      return preg_replace($whitelist, '', $string);
  }
}



if (!function_exists('strong_md5')) {
  function strong_md5(){
    $makeitstronger = time() + (7 * 24 * 60 * 60);
    $makeitstronger = md5(md5($makeitstronger)) ;
    return $makeitstronger;
  }
}


if (!function_exists('adsense')) {
  function adsense(){
    echo '   <div style="display: table;margin-right: auto;margin-left: auto;">
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
          <!-- teste -->
          <ins class="adsbygoogle"
               style="display:inline-block;width:728px;height:90px"
               data-ad-client="ca-pub-7873246719169304"
               data-ad-slot="6670787500"></ins>
          <script>
          (adsbygoogle = window.adsbygoogle || []).push({});
          </script>

          </div>';
  }
}

if (!function_exists('escape')) {
  function escape($string){
      return textile_sanitize($string);
  }
}

if (!function_exists('log_data')) {
  function log_data($action = '',$title,$data){
    $action = strtolower($action);
    $date = new DateTime("now", new DateTimeZone('America/Sao_Paulo') );
    $now =  $date->format('Y-m-d H:i:s');
    $file_name = date("Ymd");
    $basepath = __DIR__ ;
    $path = explode('application',$basepath);
    $log_path = $path[0] . '' . 'dotalogs/' . $action . '/' . $file_name . '_log.txt';

    $file = fopen($log_path,'a');
    fwrite($file,'===============================' . PHP_EOL);
    fwrite($file,$action . PHP_EOL);
    fwrite($file,$title . PHP_EOL);
    fwrite($file,$data . PHP_EOL);
    fwrite($file,$now . PHP_EOL);
    fwrite($file,'===============================' . PHP_EOL);
    fclose($file);
  }
}


if (!function_exists('init_log_data')) {
  function init_log_data($action = '',$title,$data){
    $action = strtolower($action);
    $date = new DateTime("now", new DateTimeZone('America/Sao_Paulo') );
    $now =  $date->format('Y-m-d H:i:s');
    $file_name = date("Ymd");
    $basepath = __DIR__ ;
    $path = explode('application',$basepath);
    $log_path = $path[0] . '' . 'dotalogs/' . $action . '/' . $file_name . '_log.txt';
    $file = fopen($log_path,'a');
    fwrite($file,PHP_EOL . PHP_EOL . PHP_EOL . '#############################################' . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL . PHP_EOL);
    fclose($file);
  }
}

if (!function_exists('array2Html')) {
function array2Html($data){
  $return = '';
    foreach($data as $key=>$value){
      $return .= "<tr><td>".$key."</td>";
      if(is_array($value) || is_object($value)){
          $return .= "<td>".array2Html($value)."  </td>";
      }else{
        $return .= "<td>".$value."</td></tr>";
      }
    }
        return $return;
  }
}


if (!function_exists('pretty_json')) {
function pretty_json($json, $ret= "\n", $ind="\t") {

    $beauty_json = '';
    $quote_state = FALSE;
    $level = 0;

    $json_length = strlen($json);

    for ($i = 0; $i < $json_length; $i++)
    {

        $pre = '';
        $suf = '';

        switch ($json[$i])
        {
            case '"':
                $quote_state = !$quote_state;
                break;

            case '[':
                $level++;
                break;

            case ']':
                $level--;
                $pre = $ret;
                $pre .= str_repeat($ind, $level);
                break;

            case '{':

                if ($i - 1 >= 0 && $json[$i - 1] != ',')
                {
                    $pre = $ret;
                    $pre .= str_repeat($ind, $level);
                }

                $level++;
                $suf = $ret;
                $suf .= str_repeat($ind, $level);
                break;

            case ':':
                $suf = ' ';
                break;

            case ',':

                if (!$quote_state)
                {
                    $suf = $ret;
                    $suf .= str_repeat($ind, $level);
                }
                break;

            case '}':
                $level--;

            case ']':
                $pre = $ret;
                $pre .= str_repeat($ind, $level);
                break;

        }

        $beauty_json .= $pre.$json[$i].$suf;

    }

    return $beauty_json;

}
}
if (!function_exists('do_debug')) {
  function do_debug($data,$level = true){
    echo '<pre><code>';
    if($level) {
      var_dump($data);
    } else {
      print_r($data);
    }
    echo '</code></pre>';
  }
}
