<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Facility;
use App\Models\Property;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request);

        $perPage = $request->input('perPage') ?: 5;
        
        return inertia('Facility/Index', [
            'facilities' => Facility::with('user')
                ->withCount('facilityProperties')
                ->orderBy('facility_name')
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('facility_name', 'like', "%{$search}%");
                })
                ->paginate($perPage)
                ->withQueryString(),
            'filters' => $request->only(['search', 'perPage']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Facility/Create', [
            'users' => User::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fields = $request->validate([
            'facility_name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'user_id' => ['required']
        ],[
            'user_id.required' => 'The facility head must not be empty.'
        ]);

        Facility::create($fields);

        return redirect('/facilities');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        // dd($facility->properties->paginate(5));
        // dd(Facility::with('items', 'user')->find($facility->id));
        return inertia('Facility/Show', [
            'facility' => $facility,
            'properties' => Property::where('facility_id', $facility->id)->paginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return inertia('Facility/Edit', [
            'facility' => $facility,
            'users' => User::select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {

        $fields = $request->validate([
            'facility_name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'user_id' => ['required']
        ],[
            'user_id.required' => 'The facility head must not be empty.'
        ]);

        $facname = $facility->facility_name;

        $facility->update($fields);

        return redirect('/facilities')->with('success', $facname.' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        if(!$facility->items()->exists()) {
            $facility->delete();

            return back()->with('success', 'Facility has been removed successfully.');
        } else {
            return back()->with('error', 'This facility has existing properties.');
        }
    }
}
