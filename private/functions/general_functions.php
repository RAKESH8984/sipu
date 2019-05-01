<?php
// Put all of your general functions in this file

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = PRIVATE_PATH . DS . "database" . DS . "{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}


function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}
function dtime_to_text($datetime="") {
      $unixdatetime = strtotime($datetime);
      return strftime("%d %B %Y At %X", $unixdatetime);
}

function output_message($message="",$msg_type="") {
  if (!empty($message)) { 
    switch ($msg_type) {

      case "success":
        return '<div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>'
                .$message.
              '</div>';
        break;

      case "warning":
        return '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>'
                .$message.
              '</div>';
        break;

      case "danger":
        return '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>'
                .$message.
              '</div>';
        break;

      case "info":
        return '<div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>'
                .$message.
              '</div>';
        break;

      default:
        return '<div class="alert alert-default alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>'
                .$message.
              '</div>';
        break;
    }
    
  } else {
    return "";
  }
}

function include_layout_template($template="") {
  include(APP_ROOT . DS . 'layout' . DS . $template);
}

function log_action($action, $message="") {
	$logfile = APP_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime(" %d %B , %Y", $unixdatetime);
}

function datetime_to_text_full($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function GetAge($y, $m, $d) {
  $Year = $y;
  $Month = $m;
  $Day = $d;
  $YearDifference  = date("Y") - $Year;
  $MonthDifference = date("m") - $Month;
  $DayDifference   = date("d") - $Day;
  if ($DayDifference < 0 || $MonthDifference < 0) {
    $YearDifference--;
  }
  return $YearDifference;
}

function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           case 'image/jpe': return '.jpe';
           default: return false;

       }
     }

     function pjresize($name,$filename,$new_w,$new_h,$FixSize='N')

  {

    $system=explode(".",$name);

    $count = count($system);

    if($count>0)

    {

      $ext = strtolower($system[$count-1]);

    }

    else

    {

      $ext = "";

    }

    $src_img = "";      

    

    if (preg_match("/jpg|jpeg/",$system[1])){

      $src_img=imagecreatefromjpeg($name);        

    }else if (preg_match("/png/",$system[1])){

      $src_img=imagecreatefrompng($name);       

    }else if (preg_match("/gif/",$system[1])){

      $src_img=imagecreatefromgif($name);       

    }else if (preg_match("/bmp/",$system[1])){

      $src_img=imagecreatefromwbmp($name);        

    }else if($ext=="jpg" || $ext=="jpeg" || $ext=="JPEG" || $ext=="JPG"){

      $src_img=imagecreatefromjpeg($name);

    }else if($ext=="gif" || $ext=="GIF"){

      $src_img=imagecreatefromgif($name);

    }else if($ext=="png" || $ext=="PNG"){

      $src_img=imagecreatefrompng($name);

    }else if($ext=="jpe" || $ext=="JPE"){

      $src_img=imagecreatefromwbmp($name);

    }
    else{

      $src_img=imagecreatefromjpeg($name);

    }       

    

    $old_x=imagesx($src_img);

    $old_y=imagesy($src_img); 

    

    if($FixSize=='Y')

    {

      $dst_img=imagecreatetruecolor($new_w,$new_h);

      imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $old_x, $old_y); 

    }

    else

    {

      $NewSize = getnewsize($new_w,$new_h,$name);

      $new_w = $NewSize[0];

      $new_h = $NewSize[1];

      $dst_img=imagecreatetruecolor($new_w,$new_h);

      imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h, $old_x, $old_y); 

    }

    

    if (preg_match("/png/",$system[1]))

    {

      imagepng($dst_img,$filename); 

    }

    else 

    {

      imagejpeg($dst_img,$filename,100); 

    }

    imagedestroy($dst_img); 

    imagedestroy($src_img); 

  }

  

  function getnewsize($w,$h,$path)

  {

      $size1=getimagesize($path);

  

      $oldwidth=$size1[0];

      $oldheight=$size1[1];     

  

      if($oldwidth>$w && $oldheight>$h)

      {

        $tempwidth=$oldwidth-$w;          

        $tempheight=$oldheight-$h;

        

        if($tempwidth>$tempheight)

        {

          $NewSize[0]=$w;

          $NewSize[1]=($oldheight*$NewSize[0])/$oldwidth;

        }

        elseif($tempwidth<$tempheight)

        {

          $NewSize[1]=$h;

          $NewSize[0]=($oldwidth*$NewSize[1])/$oldheight;

        }

        else

        {

          $NewSize[0]=$w;

          $NewSize[1]=$h;

        }

      }

      elseif($oldwidth>$w)

      {

        $NewSize[0]=$w;

        $NewSize[1]=($oldheight*$NewSize[0])/$oldwidth;

      }

      elseif($oldheight>$h)

      {

        $NewSize[1]=$h;

        $NewSize[0]=($oldwidth*$NewSize[1])/$oldheight;

      }

      else

      {

        $NewSize[0]=$oldwidth;

        $NewSize[1]=$oldheight;

      }

      

    return $NewSize;

  }
?>
