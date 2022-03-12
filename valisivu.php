<?php
session_start();

header('location: itsetyot.php?i=' . $_GET[i] . '#' . $_GET[minne]);
