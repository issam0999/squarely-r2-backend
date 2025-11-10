<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CenterResource;
use App\Http\Responses\ApiResponse;
use App\Models\Center;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::all();

        return ApiResponse::success(
            CenterResource::collection($centers),
            'Centers retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:centers,email',
            'description' => 'string|max:255',
            'subscription_type' => 'integer',
        ]);

        $center = Center::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'description' => $validated['description'],
            'subscription_type' => 1,
        ]);

        return ApiResponse::success(
            new CenterResource($center),
            'Center created successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Center $center)
    {
        return ApiResponse::success(new CenterResource($center), 'Center retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
