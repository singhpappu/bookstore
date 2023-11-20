<?php

namespace App\Jobs;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RefreshDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data; 

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $array = [];
        foreach ($this->data as $key => $value) {
            array_push($array, [
                'title' => $value['title'],
                'author' => $value['author'],
                'genre' => $value['genre'],
                'description' => $value['description'],
                'isbn' => $value['isbn'],
                'publication_date' => $value['published'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]); 
        }

        Book::insert($array);
    }
}
