<?php

/*
Template Name: privacy-policy

*/
$filename = "privacy-policy.docx";
header("Content-Length: " . filesize($filename));
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=privacy-policy.docx');

readfile($filename);
 get_footer('centro'); ?>