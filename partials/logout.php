<?php
session_start();


echo 'Logging out....successfully!';
session_destroy();
header('Location: ../')
?>