<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Intervention\Image\ImageManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    protected string $image;
    protected array $formats;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $image, array $formats)
    {
        //
        $this->image = $image;
        $this->formats = $formats;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->formats as $format) {
            $filename = pathinfo($this->image, PATHINFO_FILENAME);
            $manager = new ImageManager(['driver', 'gd']);
            $manager->make($this->image)
                ->fit($format, $format)
                ->rotate(45)
                ->save(public_path('uploads') . "/{$filename}/{$filename}_{$format}x{$format}.jpg");
        }
    }
}