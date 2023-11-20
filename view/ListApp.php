<?php
require('../config.php');

include ("../Controller/appoi.php");
$a1=new appointment;
$a1 -> listAppForDoctor("doc3");
?>