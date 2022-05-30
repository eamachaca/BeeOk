<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->hasTasks(25)->create();
        $this->command->info("Creating 10 users each of them with his 25 tasks");
        $tags=Tag::factory(35)->create();
        $this->command->info("Creating 35 tags without relationship because I wanna relate with some of that with each task");
        $tags=$tags->random(5);
        foreach (Task::all() as $task){
            $task->tags()->sync($tags->pluck('id'));
        }
        $this->command->comment("Finish");


//        Task::factory(5)->has(Tag::factory(5))->create();

    }
}
