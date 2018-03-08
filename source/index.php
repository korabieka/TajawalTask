<?php

namespace App;

include 'controllers/MainController.php';

use App\Controllers\MainController;
use App\Services\{ApiHandler,Validator};

$main = new MainController(new ApiHandler , new Validator);

$main->run();

