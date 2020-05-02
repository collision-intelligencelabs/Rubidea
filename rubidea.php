#!/usr/bin/env php
<?php

define( 'ABSPATH', __DIR__ . '/' );

@require_once("config/Config.inc.php");
@require_once("logger/Logger.class.php");
@require_once("rubidea/Rubidea.class.php");

$rubidea = new Rubidea();

$rubidea->banner();
$rubidea->checkLog();
$rubidea->startServer();
