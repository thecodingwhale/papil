<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Papil\Domain\Task\Models\Task::class, 1)->create([
            'user_id' => 1,
            'status' => 'pending',
            'title' => 'Get some groceries after work.'
        ]);

        factory(\Papil\Domain\Task\Models\Task::class, 1)->create([
            'user_id' => 1,
            'status' => 'completed',
            'title' => 'Buy some sticky notes.'
        ]);
    }
}
