<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# /api/v1.0/
Route::group([
    "namespace" => "App\Http\Controllers\Api\V1_0",
    "prefix" => "/v1.0",
    "as" => "api.v1_0.",
], static function () {
    # /api/v1.0/auth
    Route::group([
        "namespace" => "Auth",
        "prefix" => "/auth",
        "as" => "auth.",
    ], static function () {
        Route::post("/registration", "AuthController@registration")->name("registration");
        Route::post("/login", "AuthController@login")->name("login");
    });

    # /api/v1.0/progress
    Route::group([
        "namespace" => "Progress",
        "prefix" => "/progress",
        "as" => "progress.",
    ], static function () {
        Route::get("/get", "ProgressController@get")->name("get");
        Route::get("/getByStudent", "ProgressController@getByStudent")->name("get_by_student");
    });

    #/api/v1.0/groups
    Route::group([
        "namespace" => "Group",
        "prefix" => "/groups",
        "as" => "groups.",
    ], static function () {
        Route::post("/search", "GroupCRUDController@index")->name("search");

        Route::post("/", "GroupCRUDController@store")->name("store");
        Route::delete("/", "GroupCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/groups/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "GroupCRUDController@show")->name("show");
            Route::put("/", "GroupCRUDController@update")->name("update");
            Route::delete("/", "GroupCRUDController@destroy")->name("destroy");
        });
    });

    #/api/v1.0/students
    Route::group([
        "namespace" => "Student",
        "prefix" => "/students",
        "as" => "students.",
    ], static function () {
        Route::post("/search", "StudentCRUDController@index")->name("search");

        Route::post("/", "StudentCRUDController@store")->name("store");
        Route::delete("/", "StudentCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/students/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "StudentCRUDController@show")->name("show");
            Route::put("/", "StudentCRUDController@update")->name("update");
            Route::delete("/", "StudentCRUDController@destroy")->name("destroy");
        });
    });

    #/api/v1.0/quests
    Route::group([
        "namespace" => "Quest",
        "prefix" => "/quests",
        "as" => "quests.",
    ], static function () {
        Route::post("/search", "QuestCRUDController@index")->name("search");

        Route::post("/", "QuestCRUDController@store")->name("store");
        Route::delete("/", "QuestCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/quests/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "QuestCRUDController@show")->name("show");
            Route::put("/", "QuestCRUDController@update")->name("update");
            Route::delete("/", "QuestCRUDController@destroy")->name("destroy");
        });
    });

    #/api/v1.0/tasks
    Route::group([
        "namespace" => "Task",
        "prefix" => "/tasks",
        "as" => "tasks.",
    ], static function () {
        Route::post("/search", "TaskCRUDController@index")->name("search");

        Route::post("/", "TaskCRUDController@store")->name("store");
        Route::delete("/", "TaskCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/tasks/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "TaskCRUDController@show")->name("show");
            Route::put("/", "TaskCRUDController@update")->name("update");
            Route::delete("/", "TaskCRUDController@destroy")->name("destroy");
        });
    });

    #/api/v1.0/studentQuests
    Route::group([
        "namespace" => "StudentQuest",
        "prefix" => "/studentQuests",
        "as" => "student_quests.",
    ], static function () {
        Route::post("/search", "StudentQuestCRUDController@index")->name("search");

        Route::post("/", "StudentQuestCRUDController@store")->name("store");
        Route::delete("/", "StudentQuestCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/studentQuests/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "StudentQuestCRUDController@show")->name("show");
            Route::put("/", "StudentQuestCRUDController@update")->name("update");
            Route::delete("/", "StudentQuestCRUDController@destroy")->name("destroy");
        });
    });

    #/api/v1.0/studentTasks
    Route::group([
        "namespace" => "StudentTask",
        "prefix" => "/studentTasks",
        "as" => "student_tasks.",
    ], static function () {
        Route::post("/search", "StudentTaskCRUDController@index")->name("search");

        Route::post("/", "StudentTaskCRUDController@store")->name("store");
        Route::delete("/", "StudentTaskCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/studentTasks/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "StudentTaskCRUDController@show")->name("show");
            Route::put("/", "StudentTaskCRUDController@update")->name("update");
            Route::delete("/", "StudentTaskCRUDController@destroy")->name("destroy");
        });
    });
});


# /api/v1.0/
Route::group([
    "namespace" => "App\Http\Controllers\Api\V1_0",
    "prefix" => "/v1.0",
    "as" => "api.v1_0.",
    "middleware" => ["auth:sanctum"],
], static function () {
    # /api/v1.0/auth
    Route::group([
        "namespace" => "Auth",
        "prefix" => "/auth",
    ], static function () {
        Route::post("/logout", "AuthController@logout")->name("logout");
        Route::get("/profile", "AuthController@profile")->name("profile");
    });
});
