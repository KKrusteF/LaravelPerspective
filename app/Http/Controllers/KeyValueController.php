<?php

namespace App\Http\Controllers;

use App\Models\KeyValueStore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KeyValueController extends Controller
{
    public function addKeyValue(Request $request)
    {
        $request->validate(['key' => 'required|string', 'value' => 'required|string', 'ttl' => 'nullable|integer']);

        $ttl = $request->input('ttl');
        $expires_at = $ttl ? Carbon::now()->addSeconds($ttl) : null;

        KeyValueStore::updateOrCreate(
            ['key' => $request->input('key')],
            ['value' => $request->input('value'), 'expires_at' => $expires_at]
        );

        return response()->json(['message' => 'Key-value pair added'], 201);
    }

    public function getKeyValue($key)
    {
        $record = KeyValueStore::where('key', $key)->first();

        if ($record && (!$record->expires_at || Carbon::now()->lessThan($record->expires_at))) {
            return response()->json(['value' => $record->value], 200);
        }

        return response()->json(['message' => 'Key not found or expired'], 404);
    }

    public function deleteKeyValue($key)
    {
        $deleted = KeyValueStore::where('key', $key)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Key deleted'], 200);
        }
        return response()->json(['message' => 'Key not found'], 404);
    }
}
