<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with([
            'unit:id,name,abbreviation',
            'category:id,cat_name',
        ])->get();

        // $items = $data->map(function ($item) {
        //     return [
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'category' => $item->category->cat_name,
        //         'qty_stock' => $item->qty_stock,
        //         'unit' => $item->unit->name,
        //         'expiry_date' => $item->expiry_date,
        //     ];
        // });

        // dd($items);
        // $totalQty = 0;
        // foreach ($items as $item) {
        //     $totalQty = $item->transactions->sum('pivot.qty');
        //     // Now, $totalQty contains the total sum of qty for this item.
        // }
        $items->each(function ($item) {
            $item->used = $item->transactions->sum('pivot.qty');
        });

        // dd($totalQty);

        return inertia('Item/Index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('cat_name')
                    ->get()
                    ->map(function ($category) {
                        return [
                            'id' => $category->id,
                            'cat_name' => $category->cat_name,
                        ];
                    });

        $units = Unit::orderBy('name')
                    ->get()
                    ->map(function ($unit) {
                        return [
                            'id' => $unit->id,
                            'name' => $unit->name,
                        ];
                    });
        
        return inertia('Item/Create', [
            'categories' => $categories,
            'units' => $units,
        ]);                    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'category_id' => ['required'],
            'qty_stock' => ['required', 'numeric'],
            'unit_id' => ['required'],
        ],[
            'category_id.required' => 'The category field is required.',
            'unit_id.required' => 'Please specify a unit of quantity.',
            'qty_stock.required' => 'The quantity stock is required.',
        ]);

        $attributes = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'qty_stock' => $request->qty_stock,
            'unit_id' => $request->unit_id,
            'expiry_date' => $request->expiry_date,
        ];
        
        Item::create($attributes);

        return redirect('/items')->with('success', 'A new item has been added to the list.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::orderBy('cat_name')
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'cat_name' => $category->cat_name,
                    ];
                });

        $units = Unit::orderBy('name')
                ->get()
                ->map(function ($unit) {
                    return [
                        'id' => $unit->id,
                        'name' => $unit->name,
                    ];
                });

        return inertia('Item/Edit', [
            'categories' => $categories,
            'units' => $units,
            'item' => $item,
        ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'category_id' => ['required'],
            'qty_stock' => ['required', 'numeric'],
            'unit_id' => ['required'],
        ],[
            'category_id.required' => 'The category field is required.',
            'unit_id.required' => 'Please specify a unit of quantity.',
            'qty_stock.required' => 'The quantity stock is required.',
        ]);

        $attributes = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'qty_stock' => $request->qty_stock,
            'unit_id' => $request->unit_id,
            'expiry_date' => $request->expiry_date,
        ];

        $item->update($attributes);

        return redirect('/items')->with('success', 'Item has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // dd($item->has(''))

        $item->delete();

        return redirect('/items');
    }

    public function bulkDelete(Request $request)
    {
        
        $ids = $request->input('ids');

        if($ids) {
            Item::whereIn('id', $ids)->delete();
            return back()->with('success', 'Items has been deleted.');
        }else {
            return back()->with('error', 'There was a problem processing your request.');
        }

    }
}
