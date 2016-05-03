<?php

$collect = @file_get_contents('tmp/OpenFuego-collect.pid');
$consume = @file_get_contents('tmp/OpenFuego-consume.pid');
exec("kill -9 $collect");
exec("kill -9 $consume");