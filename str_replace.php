<? 
// filename : str_replace.php
if($argc != 4){
	echo "invalid arg! ex) php {$argv[0]} /path/to/filename\n \"before string\" \"after string\"\n";
	exit(0);
}

$fullpath = $argv[1];
$before_string = $argv[2];
$after_string = $argv[3];
$pathinfo = pathinfo(realpath($fullpath));
$newpath = $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $pathinfo['filename'] . '-replaced.' . $pathinfo['extension'];

if( ! is_file($fullpath)){
    echo "There is not $fullpath.\n";
    exit(0);
}

$fr = fopen($fullpath, "rb") or die("fopen to read failed.\n");
$fw = fopen($newpath, "w") or die("fopen to write failed.\n");

while( ! feof($fr)) {
	fwrite($fw, str_replace($before_string, $after_string, fgets($fr)));
}
fclose($fr) or die("read file handle fclose failed");
fclose($fw) or die("write file handle fclose failed");

echo "str_replace complete! $newpath is generated!\n";