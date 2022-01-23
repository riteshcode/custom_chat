<?php

use Module\Messanger\Http\Controllers\MessangerController;

Route::get('/chat',[MessangerController::class,'index']);
