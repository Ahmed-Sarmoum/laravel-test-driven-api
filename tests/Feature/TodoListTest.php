<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{

    use RefreshDatabase;

    private $todo;
    public function setUp(): void {
        parent::setUp();
        $this->todo = TodoList::factory()->create();
    }

    public function test_fetch_todo_list(): void {

        // action perform
        $response = $this->getJson(route('todo-list.fetch'));
       // dd($response->json());
        // assertion / predict
        $this->assertEquals(1, count($response->json()));
    }


    public function test_fetch_single_todo_list() {
        // action
        $response = $this->getJson(route('todo-list.show', $this->todo->id))
                                    ->assertOk()
                                    ->json();
        // assertion
        $this->assertEquals($response['name'], $this->todo->name);
    }

    public function test_store_new_todo_list() {
        $todo = TodoList::factory()->make();
        $response = $this->postJson(route('todo-list.store'), ['name' => $todo->name])
                            ->assertCreated()
                            ->json();

        $this->assertEquals($todo->name, $response['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $todo->name]);
    }

    public function test_while_storing_todo_list_name_field_is_required() {
        $this->withExceptionHandling();
        $this->postJson(route('todo-list.store'))
                                    ->assertUnprocessable() // 422
                                    ->assertJsonValidationErrors(['name']);
    }
}
