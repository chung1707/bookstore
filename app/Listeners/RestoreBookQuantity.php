<?php

namespace App\Listeners;

use App\Models\Book;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestoreBookQuantity
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
        foreach ($event->books as $item){
            $book = Book::find($item->id);
            $book->quantity += $item->pivot->quantity;
            $book->sold -= $item->pivot->quantity;
            $book->update();
        }
    }
}
