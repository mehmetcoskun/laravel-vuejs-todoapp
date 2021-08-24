<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return json_encode(Todo::all());
    }

    public function store(Request $request)
    {
        $text = $request->text;

        if ($text) {
            $todo_insert = Todo::create([
                'text' => $text
            ]);

            if ($todo_insert) {
                return json_encode(Todo::find($todo_insert->id));
            }
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $todo = Todo::find($id);

        $status = $todo->status == '1' ? '0' : '1';

        $todo_update = $todo->update([
            'status' => $status
        ]);

        if ($todo_update) {
            return json_encode([
                'status' => true
            ]);
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $todo = Todo::find($id);

        $todo_delete = $todo->delete();

        if ($todo_delete) {
            return json_encode([
                'status' => true
            ]);
        }
    }
}
