<?php

use Illuminate\Support\Facades\Route;
use Mkhodroo\Voip\Controllers\FirstOnlineTimeController;
use Mkhodroo\Voip\Controllers\VoipController;

Route::name('voip.')->prefix('voip')->middleware(['web', 'auth', 'access'])->group(function(){
    Route::get('sip-show-peers', [VoipController::class, 'sip_show_peers_status'])->name('sipShowPeers');
    Route::get('get-peer-poll-info/{queue_num}', [VoipController::class, 'getPeerPollInfo'])->name('getPeerPollInfo');
    Route::get('get-call-report/{ext_num?}', [VoipController::class, 'getCallReport'])->name('getCallReport');
    Route::get('get-call-report-by-date/{date?}', [VoipController::class, 'getCallReportByDate'])->name('getCallReportByDate');
    Route::post('dl-voice', [VoipController::class, 'dlVoice'])->name('dlVoice');
    Route::get('first-online-avg', [FirstOnlineTimeController::class, 'avg'])->name('firstOnlineAvg');

    Route::get('test', function(){
        return view('VoipViews::webphone.webphone');
    });
    Route::get('recorded-list', [VoipController::class, 'recordedList'])->name('recordedList');
});