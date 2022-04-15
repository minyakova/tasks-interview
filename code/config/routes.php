<?php

$r->addRoute('GET', "/", 'Home/index');//Home page. Authorization form
$r->addRoute('POST', "/", 'Home/index');//Home page. Authorization form
$r->addRoute('GET', "/users", 'User/getUsers');// List of users
$r->addRoute('POST', "/users", 'User/getUsers');
$r->addRoute('GET', "/singup", 'User/singUp');// Add user.

