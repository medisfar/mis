<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PdfController extends Controller{
public function updatePosition(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
    ]);

    $location = Location::find($request->id);
    if (!$location) {
        return response()->json(['success' => false]);
    }

    $location->update([
        'lat' => $request->lat,
        'lng' => $request->lng,
    ]);

    return response()->json(['success' => true]);
}}