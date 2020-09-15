<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::orderBy('id', 'DESC')->where('status', 0)->get();
        $todoDrag = Todo::orderBy('id', 'DESC')->where('status', 1)->get();

        return response()->json([
            "todo" => $todo,
            "todoDrag" => $todoDrag,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->status = 0;
        $todo->done = 0;
        $todo->name = $request->post('name');
        $todo->save();

        return response()->json([
            "status" => 'Done!',
            "id" => $todo->id
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function drag($id)
    {
        $todo = Todo::findOrFail($id);
        if($todo->status == 1){
            $todo->status = 0;
        }else{
            $todo->status = 1;
        }
        $todo->save();

        return response()->json([
            "todo" => $todo
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        if($todo->done == 0){
            $todo->done = 1;
        }else{
            $todo->done = 0;
        }
        $todo->save();

        return response()->json([
            "status" => 'Done update!'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();

        return response()->json([
            "status" => 'Done!'
        ],200);
    }
}
