<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Ecourse;

class CheckEcourseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-ecourse-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check ecourse and category data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== CATEGORIES ===');
        $categories = Category::all();
        foreach ($categories as $cat) {
            $this->line("ID: {$cat->id_category}, Name: {$cat->name}");
        }

        $this->info('=== ECOURSES ===');
        $ecourses = Ecourse::all();
        foreach ($ecourses as $course) {
            $this->line("ID: {$course->id_course}, Name: {$course->name}, Category: {$course->id_category}");
        }
    }
}
