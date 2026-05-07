<?php

use App\Models\SiteInfo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $siteInfo = SiteInfo::getSiteInfo();
    return view('welcome', compact('siteInfo'));
});