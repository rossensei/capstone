<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();

        foreach($transactions as $trans) {

            $numOfItems = fake()->randomElement(range(1,15)); //number of items to be added per transaction

            for($i = 1; $i <= $numOfItems; $i++) {

                $itemId = mt_rand(1, Item::count());
                $qty = mt_rand(1, 15);

                $trans->items()->attach($itemId, [ 'qty' => $qty ]);

                $item = Item::find($itemId);

                $item->qty = $item->qty - $qty;

                $item->save();
            }
        }
    }
}
