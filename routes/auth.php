<?php

Route::redirect('/.well-known/change-password', '/settings/password');

Auth::routes(['verify' => true]);