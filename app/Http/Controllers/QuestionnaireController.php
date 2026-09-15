<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{
    public function index(): View
    {
        return view('questionnaire');
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'location'          => 'required|string|max:255',
            'birthday'          => 'required|date',
            'favorite_color'    => 'required|string|max:255',
            'favorite_food'     => 'required|string|max:255',
            'favorite_movie'    => 'required|string|max:255',
            'favorite_song'     => 'required|string|max:255',
            'favorite_memory'   => 'required|string',
            'favorite_place'    => 'required|string|max:255',
            'favorite_snack'    => 'required|string|max:255',
            'dream_destination' => 'required|string|max:255',
            'anything_else'     => 'nullable|string',
        ]);

        $validated['ip_address'] = $request->ip();

        Response::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Response saved successfully!'
        ], 201);
    }
}