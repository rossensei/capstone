<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Facility;
use App\Models\Item;

class GlobalSearchController extends Controller
{
    public function search()
    {
        return inertia('GlobalSearchResult', [
            'results' => Search::addMany([
                [User::class, 'name'],
                [Facility::class, 'name'],
                [Item::class, 'name'],
            ])
            ->beginWithWildcard()
            ->paginate()
            ->get($request->get('term'))
            ]);
    }
}
