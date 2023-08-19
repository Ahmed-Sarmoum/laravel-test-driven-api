<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    public function index() {
        $list = TodoList::all();
        return response()->json($list);
    }

    public function show(TodoList $todo) {

        return response()->json($todo);
    }

    public function store(Request $req) {

        $req->validate(['name' => ['required']]);

        return TodoList::create( $req->all());
    }

    public function destroy(TodoList $todo) {

        $todo->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoList $todo, Request $req) {
        $req->validate(['name' => ['required']]);

        return  $todo->update($req->all());
    }
}
