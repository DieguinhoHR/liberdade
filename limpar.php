<?php

session_start();
session_destroy();
session_start();
if(isset($_SESSION['chart']))
{
	unset($_SESSION['chart']);
}