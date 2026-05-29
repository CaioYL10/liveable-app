<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyLike;
use Illuminate\Http\Request;

class PropertyLikeController extends Controller
{
    public function toggleLike(Property $property, Request $request)
    {
        $userId = $request->user()->id;

        $like = PropertyLike::where(['property_id' => $property->id, 'user_id' => $userId])->first();

        if ($like) {
            $like->delete();

            return response()->json(['message' => 'Liked removed successfully', 'liked' => false], 200);
        }
        PropertyLike::create([
            'property_id' => $property->id,
            'user_id' => $userId,
        ]);
        return response()->json(['message' => 'Liked successfully', 'liked' => true], 201);
    }
}
