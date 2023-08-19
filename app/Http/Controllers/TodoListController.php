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
}
