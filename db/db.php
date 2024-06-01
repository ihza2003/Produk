<?php

$con = mysqli_connect("localhost", "root", "", "mentoring");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
