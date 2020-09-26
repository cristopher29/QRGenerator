<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
    || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
) {
    exit;
}
date_default_timezone_set('UTC');
require dirname(dirname(__FILE__))."/config.php";

$output_data = false;

$outdir = $_CONFIG['qrcodes_dir'];
$PNG_TEMP_DIR = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$outdir.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = $outdir.'/';

require dirname(dirname(__FILE__))."/lib/phpqrcode.php";
require dirname(dirname(__FILE__))."/lib/class-qrcdr.php";
require dirname(dirname(__FILE__))."/include/functions.php";

$output_data = false;
$setbackcolor = filter_input(INPUT_POST, "backcolor", FILTER_SANITIZE_STRING);
$setfrontcolor = filter_input(INPUT_POST, "frontcolor", FILTER_SANITIZE_STRING);
$optionlogo = filter_input(INPUT_POST, "optionlogo", FILTER_SANITIZE_STRING);
$pattern = filter_input(INPUT_POST, "pattern", FILTER_SANITIZE_STRING);
$markerOut = filter_input(INPUT_POST, "marker", FILTER_SANITIZE_STRING);
$markerIn = filter_input(INPUT_POST, "marker_in", FILTER_SANITIZE_STRING);
$markerOutColor = filter_input(INPUT_POST, "marker_out_color", FILTER_SANITIZE_STRING);
$markerInColor = filter_input(INPUT_POST, "marker_in_color", FILTER_SANITIZE_STRING);
$gradient = isset($_POST['gradient']);
$gradient_color = filter_input(INPUT_POST, "gradient_color", FILTER_SANITIZE_STRING);
$markers_color = isset($_POST['markers_color']);
$radial = isset($_POST['radial']);

$optionlogo = $optionlogo ? $optionlogo : 'none';

$optionstyle = array(
    'optionlogo' => $optionlogo,
    'pattern' => $pattern,
    'marker_out' => $markerOut,
    'marker_in' => $markerIn,
    'marker_out_color' => $markerOutColor,
    'marker_in_color' => $markerInColor,
    'gradient' => $gradient,
    'gradient_color' => $gradient_color,
    'markers_color' => $markers_color,
    'radial' => $radial,
);

if ($setbackcolor) {
    $stringbackcolor = $setbackcolor;
}
if ($setfrontcolor) {
    $stringfrontcolor = $setfrontcolor;
}

$backcolor = hexdec(str_replace('#', '0x', $stringbackcolor));
$frontcolor = hexdec(str_replace('#', '0x', $stringfrontcolor));

$level = filter_input(INPUT_POST, "level", FILTER_SANITIZE_STRING);
$size = filter_input(INPUT_POST, "size", FILTER_SANITIZE_STRING);

if (in_array($level, array('L','M','Q','H'))) {
    $errorCorrectionLevel = $level;    
}
if ($size) {
    $matrixPointSize = min(max((int)$size, 4), 32);
}

$output_data = filter_input(INPUT_POST, "link", FILTER_VALIDATE_URL);

if ($output_data) {

    $backcolor = isset($_POST['transparent']) ? 'transparent' : $backcolor;

    $optionlogo = $optionlogo && $optionlogo !== 'none' ? $optionlogo : false;
    $filename = $PNG_TEMP_DIR.md5($output_data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize.time());
    $filenamesvg = $filename.'.svg';

    $finalsvg = basename($filenamesvg);

    QRcdr::svg($output_data, $filenamesvg, $errorCorrectionLevel, $matrixPointSize, 2, false, $backcolor, $frontcolor, $optionstyle);

    $placeholder = $PNG_WEB_DIR.$finalsvg;

    $result = array(
        // 'png'=> $finalpng, 
        // 'eps'=> $finaleps, 
        'filename' => $finalsvg,
        'placeholder'=> $placeholder,
        // 'errore' => $generated_svg,
        );

    $result = json_encode($result);
} else {
    $result = json_encode(array('errore'=> 'Por favor, introduce más datos', 'placeholder' => $_CONFIG['placeholder']));
}
echo $result;
