<?php

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. OBTENER TODAS LAS TAREAS
Route::get('/tareas', function () {
    return response()->json([
        'status' => 'success',
        'data' => Tarea::all()
    ]);
});

// 2. CREAR UNA NUEVA TAREA
Route::post('/tareas', function (Request $request) {
    $tarea = Tarea::create($request->all());
    return response()->json([
        'status' => 'success',
        'data' => $tarea
    ], 201);
});

// 3. ACTUALIZAR UNA TAREA
Route::put('/tareas/{id}', function (Request $request, $id) {
    $tarea = Tarea::findOrFail($id);
    $tarea->update($request->all());
    return response()->json([
        'status' => 'success',
        'data' => $tarea
    ]);
});

// 4. ELIMINAR UNA TAREA
Route::delete('/tareas/{id}', function ($id) {
    Tarea::destroy($id);
    return response()->json([
        'status' => 'success',
        'message' => 'Tarea eliminada'
    ]);
});