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
            'completed' => false,
            'text' => 'Get some groceries after work.'
        ]);

        factory(\Papil\Domain\Task\Models\Task::class, 1)->create([
            'user_id' => 1,
            'completed' => true,
            'text' => 'Buy some sticky notes.'
        ]);
    }
}
