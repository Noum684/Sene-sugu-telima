<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return Message::with(['envoyeur', 'receveur'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'envoyeur_id' => 'required|exists:users,id',
            'receveur_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create($request->all());
        return response()->json($message, 201);
    }

    public function show(Message $message)
    {
        return $message->load(['envoyeur', 'receveur']);
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $message->update($request->only('content'));
        return response()->json($message, 200);
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(null, 204);
    }
}

