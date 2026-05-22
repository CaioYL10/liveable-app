<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return response()->json($properties, 200);
    }

    public function store(Request $request)
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
        Property::create($request->all());
        return response()->json('Property created', 201);
    }

    public function show(Property $property)
    {
        $property = Property::findOrFail($property->id);
        return response()->json(['Propriedade' => $property]);
    }

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

    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json(['message' => 'Propriedade deletada com sucesso!'], 201);
    }
}
