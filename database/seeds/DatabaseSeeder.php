<?php


use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Schema::disableForeignKeyConstraints();
      User::query()->truncate();
      $items = [
          [
              'id' => 1,
              'first_name' => 'Admin',
              'last_name' => 'John',
              'email' => 'admin@demo.com',
              'password' => Hash::make("admin@demo.com"),
              'created_at' => now(),
          ]
      ];

      foreach ($items as $item) {
          User::updateOrCreate(['id' => $item['id']], $item);
      }
      Schema::enableForeignKeyConstraints();
    }
}
