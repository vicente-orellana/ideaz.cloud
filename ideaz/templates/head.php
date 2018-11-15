<?php
  ob_start();
  session_start();
  require_once("includes/config.php");
  include_once("includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ideaz.Cloud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <link rel="stylesheet" href="/templates/css/main.css">
  <link rel="stylesheet" href="/templates/css/redactor.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="/templates/css/basic.css" />
  <link rel="stylesheet" href="/templates/css/dropzone.css" />
  <script type-"text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script type-"text/javascript" src="/templates/js/load.js"></script>
  <script src="/templates/js/redactor.js"></script>
  <script src="/templates/js/dropzone.js"></script>
  <script src="/templates/js/dropzone-amd-module.js"></script>
</head>

<body>
  <div class="loader"></div>
  <div class="container-fluid text-center">
   <h1 id="logo"><a href="/"><i class="fa fa-lightbulb-o"></i> Ideaz.cloud</a></h1>
  </div>
  <div class="container-fluid" id="wrapper">
    <?php user_bar(); ?>

    <div class="row">
      <?php nav_bar(); ?>

        <div class="col-xs-12">