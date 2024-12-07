<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use GuzzleHttp\Psr7\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $todos = Todo::all();
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'get todos list successfully',
                'data' => $todos,
            ], 201);

        }

        catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // For debugging; remove in production
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        try {
            //$todo= Todo($request->validated());
            $todo = Todo::create($request->validated());
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'todocreated successfully',
                'data' => $todo, // Return the created todoobject
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Include validation error messages
            ], 422);

        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // For debugging; remove in production
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {

        try {
            //$todo= Todo($request->validated());
            $todo->title = $request->title;
            $todo->save();
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'todocreated successfully',
                'data' => $todo, // Return the created todoobject
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Include validation error messages
            ], 422);

        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // For debugging; remove in production
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        try {
            //$todo= Todo($request->validated());
            $todo->delete();
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'todocreated successfully',

            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Include validation error messages
            ], 422);

        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // For debugging; remove in production
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(Todo $todo)
    {
        try {
            //$todo= Todo($request->validated());
            $todo->status = !$todo->status;
            $todo->save();
            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'todocreated successfully',
                'data' => $todo, // Return the created todo object
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(), // Include validation error messages
            ], 422);

        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(), // For debugging; remove in production
            ], 500);
        }
    }
}
