<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rustam
 * Date: 25.02.13
 * Time: 11:43
 * To change this template use File | Settings | File Templates.
 */

move_uploaded_file($_FILES['upload']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/'.$_FILES['upload']['name']);?>
<script type="text/javascript">
	window.parent.document.getElementById('cke_109_textInput').value='/images/<?=$_FILES['upload']['name']?>';
	window.parent.document.getElementById('cke_info_146').click();
</script>