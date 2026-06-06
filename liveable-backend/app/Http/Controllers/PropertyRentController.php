<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Rent;

class PropertyRentController extends Controller
{
    public function store(Request $request, Property $property)
    {
        // Cria o aluguel vinculado ao imóvel e ao usuário logado via Sanctum
        $rent = $property->rents()->create([
            'user_id' => $request->user()->id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guests_count' => $request->guests_count,
            'details' => $request->details,
            'has_pet' => $request->has_pet,
        ]);

        return response()->json([
            'message' => 'Imóvel alugado com sucesso!',
            'rent' => $rent
        ], 201);
    }
}
