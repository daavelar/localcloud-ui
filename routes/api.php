<?php

use App\Http\Controllers\BucketController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

Route::get('queues', [QueueController::class, 'index']);
Route::post('queues', [QueueController::class, 'store']);
Route::post('queues/delete', [QueueController::class, 'destroy']);
Route::put('queues/{queue}', [QueueController::class, 'update']);
Route::get('queues/{queue}', [QueueController::class, 'show']);
Route::post('queues/purge', [QueueController::class, 'purge']);

Route::get('queues/{queue}/messages', [QueueController::class, 'messages']);

Route::delete('messages/{id}', [MessageController::class, 'destroy']);
Route::post('messages/send', [MessageController::class, 'sendMessage']);

Route::get('topics', [TopicController::class, 'index']);
Route::post('topics', [TopicController::class, 'store']);
Route::delete('topics/{name}', [TopicController::class, 'destroy']);

Route::get('subscriptions', [SubscriptionController::class, 'index']);
Route::post('subscriptions', [SubscriptionController::class, 'store']);
Route::get('topics/{topic}/subscriptions', [SubscriptionController::class, 'topic']);
Route::post('subscriptions/delete', [SubscriptionController::class, 'destroy']);

Route::get('buckets', [BucketController::class, 'index']);
Route::post('buckets', [BucketController::class, 'store']);
Route::delete('buckets/{name}', [BucketController::class, 'destroy']);
Route::get('buckets/{name}', [BucketController::class, 'show']);
