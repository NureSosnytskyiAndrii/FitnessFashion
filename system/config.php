<?php

/** Database configuration BEGIN **/
const DB_HOST = 'localhost';
const DB_NAME = 'fitness_fashion';
const DB_USER = 'root';
const DB_PASSWORD = 'root';

/** Database configuration END **/

$mysqli = new mysqli();
$mysqli->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
