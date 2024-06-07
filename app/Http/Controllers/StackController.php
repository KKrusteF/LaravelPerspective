<?php

namespace App\Http\Controllers;

use App\Models\Stack;
use Illuminate\Http\Request;

class StackController extends Controller
{
    public function addToStack(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
        ]);
        $stack = new Stack();
        $value = $request->input('value');
        $stack->value = $value;
        $stack->save();
        return response()->json(['message' => 'Value ' . $value . 'added to stack']);
    }

    public function getFromStack()
    {
        $value = Stack::orderBy('created_at', 'desc')->first();
        if ($value) {
            $newValue = $value->value;
            $value->delete();
            return response()->json(['value' => $newValue]);
        }
        return response()->json(['message' => 'Stack is empty'], 404);
    }
}
