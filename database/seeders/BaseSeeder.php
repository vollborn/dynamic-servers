<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getData() as $data) {
            $this->getClass()::firstOrCreate($data);
        }
    }

    /**
     * @return string
     */
    abstract protected function getClass(): string;

    /**
     * @return array
     */
    abstract protected function getData(): array;
}
