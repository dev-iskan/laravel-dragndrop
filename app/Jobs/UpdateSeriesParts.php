<?php

namespace App\Jobs;

use App\Series;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateSeriesParts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $series;
    public $parts;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Series $series, $updated_parts)
    {
        $this->series = $series;
        $this->parts = $updated_parts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->series->parts->each(function ($part, $index) {
            $part->update(array_only($this->parts[$index], ['title', 'sort_order']));
        });
    }
}
