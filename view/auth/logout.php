<?php

session_start();

unset($_SESSION["id_user"]);
unset($_SESSION["level"]);
unset($_SESSION["nm_user"]);


session_unset();
session_destroy();

header('Location: login');
