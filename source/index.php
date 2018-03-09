<?php

namespace App;

include 'controllers/MainController.php';

use App\Controllers\MainController;
use App\Services\{ApiHandler,Validator,HotelMapperService};

$main = new MainController(new ApiHandler , new Validator , new HotelMapperService);

$main->run();

