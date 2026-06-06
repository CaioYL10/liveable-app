<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index()
{
    $properties = Property::with('images')->get();

    $properties->transform(function ($property) {

        $property->images->transform(function ($image) {

            $image->url = asset('storage/' . $image->path);

            return $image;
        });

        return $property;
    });

    return response()->json($properties, 200);
}

    #[Authorize('adminOrOwner')]
    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'local' => 'required|string',
            'type' => 'required|string',
            'beds_qtd' => 'required|integer',
            'toilette' => 'required|integer',
            'area' => 'required|integer',
            'property_title' => 'required|string',
            'wifi' => 'boolean',
            'tv' => 'boolean',
            'cooler' => 'boolean',
            'air_conditioning' => 'boolean',
            'washer' => 'boolean',
            'microwave' => 'boolean',
            'contract' => 'string',
            'images' => '',
            'pricePerDay' => 'required|integer',
            'pricePerWeek' => 'integer',
            'pricePerMonth' => 'integer',
            'status' => 'required|string',
            'property_reviews_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $property = Auth::user()->property()->create($request->only([
            'local',
            'type',
            'beds_qtd',
            'toilette',
            'area',
            'property_title',
            'wifi',
            'tv',
            'cooler',
            'air_conditioning',
            'washer',
            'microwave',
            'pricePerDay',
            'status',
        ]));

        if ($request->hasFile('images')) {
            $titleDirectory = $request->property_title;
            $directory = "assets/images/properties/$titleDirectory";
            Storage::disk('public')->makeDirectory($directory);

            foreach ($request->images as $image) {
                $property_image_path = $image->storeAs($directory, $image->getClientOriginalName(), 'public');
                $newImage = PropertyImage::create([
                    'property_id' => $property->id,
                    'path' => $property_image_path,
                ]);
                if (!isset($property->property_image_id)) {
                    $property->update(['property_image_id' => $newImage->id]);
                }
            }
        }

        return response()->json(['message' => 'Property Created'], 201);
    }

    public function show(Property $property)
    {
        $property = Property::findOrFail($property->id);
        return response()->json(['Propriedade' => $property]);
    }

    #[Authorize('adminOrOwner')]
    public function update(Request $request, Property $property)
    {
        $validator = Validator::make($request->all(), [
            'local' => 'required|string',
            'type' => 'required|string',
            'beds_qtd' => 'required|integer',
            'toilette' => 'required|integer',
            'area' => 'required|integer',
            'owner_contact' => 'required|string',
            'property_title' => 'required|string',
            'wifi' => 'boolean',
            'tv' => 'boolean',
            'cooler' => 'boolean',
            'air_conditioning' => 'boolean',
            'washer' => 'boolean',
            'microwave' => 'boolean',
            'contract' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($property->update($request->all())) {
            return response()->json(['message' => 'Propriedade atualizada com sucesso!'], 201);
        }
        return response()->json(['message' => 'Erro ao atualizar propriedade!'], 401);
    }

    #[Authorize('adminOrOwner')]
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'Propriedade deletada com sucesso!'], 201);
    }

    public function toggleRentProperty(Property $property)
    {
        if ($property->isRent($property)) { // returns true
            return response()->json(['message' => 'Propriedade já alugada'], 400);
        }
        if ($property->update(['status' => 'rent'])) {
            return response()->json(['message' => 'Propriedade alugada com sucesso!'], 201);
        }
    }

    public function toggleEnableProperty(Property $property)
    {
        if ($property->isEnabled($property)) { // returns enabled
            return response()->json(['message' => 'Propriedade Disponível'], 200);
        }
        return response()->json(['message' => 'Propriedade desabilitada pelo administrador'], 201);
    }
}
