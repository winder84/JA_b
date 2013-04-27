<?php

require_once('functions.php');

if(isset($_REQUEST["ajax"])){
	$selectedpath = urldecode($_REQUEST["path"]);
	if($selectedpath = checkpath($selectedpath, $uploadpath)){
		$dirs = getDirTree(DOCUMENTROOT.$selectedpath, true, false);
	} else {
		die('0||'.translate("The folder path was tampered with!"));
	}
} else {
	$selectedpath = $uploadpath;	
}

print '<ul id="large_images" class="files clear">' . "\n";

$htmlFiles = '';
$htmlFolders = '';
					
foreach($dirs as $key => $value){
    if($value != "folder"){
        if(strtolower($value) == "png" || strtolower($value) == "jpg" || strtolower($value) == "jpeg" || strtolower($value) == "gif" || strtolower($value) == "bmp"){

            $htmlFiles .= sprintf('                    <li>
                        <a href="%1$s" title="%2$s" class="image">
                            <span class="begin"></span>
                            <span class="filename">%2$s</span>
                            <span class="icon image"><img width="100" height="100" src="%1$s" /></span>
                        </a>
                    </li>' . "\n", 
                    $selectedpath.$key, 
                    $key, 
                    $value, 
                    urlencode($selectedpath.$key));	
        } else {

            $htmlFiles .= sprintf('                    <li>
                        <a href="%1$s" title="%2$s" class="file">
                            <span class="begin"></span>
                            <span class="filename">%2$s</span>
                            <span class="icon %3$s"></span>
                        </a>
                    </li>' . "\n", 
                    $selectedpath.$key, 
                    $key, 
                    $value);	
        }
    } else {

        $htmlFolders .= sprintf('                    <li>
                        <a href="%1$s" title="%2$s" class="folder">
                            <span class="begin"></span>
                            <span class="filename">%2$s</span>
                            <span class="icon folder"></span>
                        </a>
                    </li>' . "\n", 
                    $selectedpath.$key."/", 
                    $key);
    }
}

print $htmlFolders;
print $htmlFiles;
print '                </ul>'."\n";
?>