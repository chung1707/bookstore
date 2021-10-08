<?php

namespace App\Listeners;

use App\Models\Book;
use App\Models\AppConst;
use App\Models\ImportBills;
use Illuminate\Support\Str;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateImportBills
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $books = $event->bill[0];
        $importbill = new ImportBills;
        $importbill->transaction_id = Str::random(AppConst::TRANSACTION_CODE);
        $importbill->supplier_id = $event->bill[1];
        $importbill->totalPrice = $event->bill[2];
        $importbill->user_id = auth()->user()->id;
        $importbill->save();
        foreach ($books as $book){
            $item  = Book::where('book_code', '=', $book['book_code'])->first();
            $importbill->books()->attach($item,['quantity' => $book['quantity'], 'price' => $book['price']]);
        }
    }
}
