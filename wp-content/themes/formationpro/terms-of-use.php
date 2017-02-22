<?php

/*
Template Name: terms-of-use

*/
$filename = "terms-of-use.docx";
header("Content-Length: " . filesize($filename));
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=terms-of-use.docx');

readfile($filename);
 get_footer('centro'); ?>