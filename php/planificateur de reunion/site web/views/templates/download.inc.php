<?


$localPath = realpath("file/sondage.xlsx");
if (!file_exists($localPath)) {
  exit("Cannot find file located at '$localPath'");
}

ob_clean();

header('Pragma: public'); // required   
header('Content-Length: '.filesize($localPath));  
header('Content-Type: application/octet-stream');  
header('Content-Disposition: attachment; filename="sondage.xlsx"');  
header('Content-Transfer-Encoding: binary');  
header('Cache-Control: must-revalidate, post-check=0, pre-check=0', false);  
header('Cache-Control: private', false); // required for certain browsers  

readfile($localPath);
exit;

?>
