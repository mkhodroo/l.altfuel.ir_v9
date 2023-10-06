<?php 

namespace Mkhodroo\MkhodrooProcessMaker;

use Illuminate\Support\Facades\Route;
use Mkhodroo\MkhodrooProcessMaker\Controllers\CaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\DeleteCaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\DraftCaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\DynaFormController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\GetCaseVarsController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\InboxController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\NewCaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\PMVacationController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\ProcessController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\SetCaseVarsController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\StartCaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\ToDoCaseController;
use Mkhodroo\MkhodrooProcessMaker\Controllers\TriggerController;

Route::name('MkhodrooProcessMaker.')->prefix('pm')->middleware(['web', 'auth', 'access'])->group(function(){
    Route::get('test', function(){
        return TriggerController::excute('68379534364e3501fd57709063851566', '93343989764edeb050b47e1073801809', '2');
    });
    Route::get('inbox', [CaseController::class, 'get'])->name('inbox');
    Route::get('new-case', [CaseController::class, 'newCase'])->name('newCase');
    Route::name('report.')->prefix('report')->group(function(){
        Route::get('number-of-my-vacations', [PMVacationController::class, 'numberOfMyVacation'])->name('numberOfMyVacation');
    });
    Route::name('forms.')->prefix('forms')->group(function(){
        Route::get('start', [StartCaseController::class, 'form'])->name('start');
        Route::get('todo', [ToDoCaseController::class, 'form'])->name('todo');
        Route::get('draft', [DraftCaseController::class, 'form'])->name('draft');
    });

    Route::name('api.')->prefix('api')->group(function(){
        Route::get('start-process', [StartCaseController::class, 'get'])->name('startProcess');
        Route::post('new-case', [NewCaseController::class, 'create'])->name('newCase');
        Route::get('todo', [ToDoCaseController::class, 'getMyCase'])->name('todo');
        Route::get('draft', [DraftCaseController::class, 'getMyCase'])->name('draft');
        Route::post('get-case-dynaForm', [DynaFormController::class, 'get'])->name('getCaseDynaForm');
        Route::post('save-and-next', [SetCaseVarsController::class, 'saveAndNext'])->name('saveAndNext');
        Route::post('save', [SetCaseVarsController::class, 'save'])->name('save');
        Route::get('get-case-vars/{caseId}', [GetCaseVarsController::class, 'getByCaseId'])->name('getCaseVars');
        Route::get('get-case-info/{caseId}/{delIndex}', [CaseController::class, 'getCaseInfo'])->name('getCaseInfo');
        Route::get('delete-case/{caseId}', [DeleteCaseController::class, 'byCaseId'])->name('deleteCase');

        Route::name('process.')->prefix('process')->group(function(){
            Route::get('get-by-id/{process_id}', [ProcessController::class, 'getNameById']);
        });
    });
});