<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Models\FacilityProperty;

class FacilityPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Facility $facility)
    {
        // dd($facility);
        $properties = FacilityProperty::where('facility_id', $facility->id)
            ->paginate(3);

        $num = 1;
        foreach($properties as $prop) {
            $prop->number = $num++;
        }

        dd($properties);
        return inertia('Facility/Show.vue', [
           'facility' => $facility,
           'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FacilityProperty $facilityProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacilityProperty $facilityProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacilityProperty $facilityProperty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacilityProperty $facilityProperty)
    {
        //
    }
}
