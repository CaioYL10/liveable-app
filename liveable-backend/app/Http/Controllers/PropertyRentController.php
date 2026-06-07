<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Rent;

class PropertyRentController extends Controller
{
    public function index(Property $property)
    {
        return $property->rents()->get(['checkin', 'checkout']);
    }

    public function store(Request $request, Property $property)
    {
        $rent = $property->rents()->create([
            'user_id'      => $request->user()->id,
            'checkin'      => $request->checkin,
            'checkout'     => $request->checkout,
            'guests_count' => $request->guests_count,
            'details'      => $request->details,
            'has_pet'      => $request->has_pet,
        ]);

        return response()->json([
            'message' => 'Imóvel alugado com sucesso!',
            'rent'    => $rent,
        ], 201);
    }

    public function pendingRents(Request $request)
    {
        $user = $request->user();

        $reservas = Rent::whereHas('property', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('confirmed', false)
            ->with([
                'property:id,property_title,pricePerDay,user_id',
                'property.images',
                'user:id,name,profile_picture',
            ])
            ->get()
            ->map(fn($rent) => [
                'rent_id'      => $rent->id,
                'checkin'      => $rent->checkin,
                'checkout'     => $rent->checkout,
                'guests_count' => $rent->guests_count,
                'has_pet'      => $rent->has_pet,
                'details'      => $rent->details,
                'confirmed'    => $rent->confirmed,
                'property' => [
                    'id'            => $rent->property->id,
                    'title'         => $rent->property->property_title,
                    'price_per_day' => $rent->property->pricePerDay,
                    'image' => $rent->property->images->first()?->url ?? null,
                ],
                'requester' => [
                    'id'     => $rent->user->id,
                    'name'   => $rent->user->name,
                    'avatar' => $rent->user->profile_picture ?? null,
                ],
            ]);

        return response()->json($reservas);
    }

    public function updateStatus(Request $request, Rent $rent)
    {
        if ($rent->property->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        $request->validate([
            'confirmed' => 'required|boolean',
        ]);

        if ($request->confirmed) {
            // Aceitar — apenas marca como confirmado
            $rent->update(['confirmed' => true]);
            return response()->json(['message' => 'Reserva confirmada.']);
        } else {
            // Recusar — deleta o registro
            $rent->delete();
            return response()->json(['message' => 'Reserva recusada e removida.']);
        }
    }
}