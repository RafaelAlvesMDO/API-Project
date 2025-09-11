<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Listar todas as tasks
    public function index()
    {
        // Inclui dados do usuário relacionado
        $tasks = Task::with('user')->get();
        return response()->json($tasks, 200);
    }

    // Criar uma nova task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    // Mostrar task específica
    public function show($id)
    {
        $task = Task::with('user')->findOrFail($id);
        return response()->json($task, 200);
    }

    // Atualizar task
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'user_id' => 'sometimes|required|exists:users,id',
        ]);

        $task->update($validated);

        return response()->json($task, 200);
    }

    // Deletar task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}
