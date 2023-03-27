<?php

namespace App\Http\Controllers;

use App\Models\Generate;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllGenerates()
    {
        $generate = Generate::get()->toJson(JSON_PRETTY_PRINT);
        return response($generate, 200);
    }

    public function createGenerate(Request $request)
    {
        $generate = new Generate;
        $generate->name = $request->name;
        $generate->linkedin = $request->linkedin;
        $generate->github = $request->github;
        $generate->save();

        return response()->json([
            "message" => "generate record created"
        ], 201);
    }

    public function getGenerate($id)
    {
        if (Generate::where('name', 'LIKE', '%' . $id . '%')->exists()) {
            $generate = generate::where('name', 'LIKE', '%' . $id . '%')->get()->toJson(JSON_PRETTY_PRINT);
            return response($generate, 200);
        } else {
            return response()->json([
                "message" => "generate not found"
            ], 404);
        }
    }
}
