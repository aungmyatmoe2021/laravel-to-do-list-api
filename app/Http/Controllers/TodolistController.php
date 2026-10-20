<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistRequest;
use App\Http\Resources\TodolistResource;
use App\Models\Todolist;
use Exception;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $todolists = Todolist::latest()->get();
            return response()->json([
                'message'=>'Todolist retrived successfully',
                'data'=>TodolistResource::collection($todolists)
            ],200);
        }catch(Exception $e){
            return response()->json(['message'=>'Server Error'],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This is for Web application
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodolistRequest $request)
    {
        try{
            $todolist = Todolist::create([
                'title'=>$request->title,
                'description'=>$request->description,
                'status'=>$request->status
            ]);
            return response()->json([
                'message'=>'Todolist created successfully',
                'data'=>TodolistResource::make($todolist)
            ],201);
        }catch(Exception $e){
            return response()->json(['message'=>'Server Error'],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $todolist = Todolist::find($id);
            if(!$todolist){
                return response([
                    'message'=>'No Records Found'
                ],404,[]);
            }
            return response()->json([
                "message"=>"Todolist retrieved successfully",
                "data" => TodolistResource::make($todolist)
            ]);
        }catch(Exception $e){
            return response()->json(['message'=>'Server Error'],500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This is for Web application
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodolistRequest $request, string $id)
    {
        try{
            $todolist = Todolist::find($id);
            if(!$todolist){
                return response(['message'=>'No Records Found'],404,[]);
            }
            $todolist->title = $request->title;
            $todolist->description = $request->description;
            $todolist->status = $request->status;
            $todolist->save();
            return response()->json([
                'message'=>'Todolist updated successfully',
                'data'=>TodolistResource::make($todolist)
            ]);
        }catch(Exception $e){
            return response()->json(['message'=>'Server Error'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $todolist = Todolist::find($id);
            $todolist->delete();
            return response()->json([
                "message"=>"Todolist deleted successfully"
            ]);
        }catch(Exception $e){
            return response()->json(['message'=>'Server Error'],500);
        }
    }
}
