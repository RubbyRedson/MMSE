<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesTableSeeder::class); // Roles must be before Users
        $this->call(UsersTableSeeder::class);
        $this->call(SelectionsTableSeeder::class); // Selections must be after Users
        $this->call(EmployeesTableSeeder::class); // Employees must be after Users

        $this->call(ClientsTableSeeder::class); // Clients must be before Projects
        $this->call(ProjectsTableSeeder::class);

        $this->call(SubteamsTableSeeder::class);
        $this->call(SubteamRequestsTableSeeder::class); // SubteamRequests must be after Subteams
    }
}

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'title' => 'Customer service',
            'description' => 'Description of Customer service',
            'auth' => 1,
        ]);
        DB::table('roles')->insert([
            'title' => 'Customer service manager',
            'description' => 'Description of Customer service manager',
            'auth' => 2,
        ]);
    }
}

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => 'Pear LLC',
            'phone' => '123321123',
            'discount' => 0,
        ]);
        DB::table('clients')->insert([
            'name' => 'AEKI',
            'phone' => '0987654321',
            'discount' => 75,
        ]);
    }
}

class PlanningRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planning_requests')->insert([
            'client' => 1,
            'feedback' => 'Feedback for request 1',
        ]);
        DB::table('planning_requests')->insert([
            'client' => 2,
            'feedback' => 'Feedback for request 2',
        ]);
    }
}

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Birthday Party',
            'client' => 1,
            'description' => 'Birthday Party description',
            'cost' => 500,
            'start' => date('2001-10-05'),
            'stop' => date('2001-10-27'),
        ]);
        DB::table('projects')->insert([
            'name' => 'Fika',
            'client' => 2,
            'description' => 'Fika description',
            'cost' => 700,
            'start' => date('2007-11-13'),
            'stop' => date('2007-12-27'),
        ]);
    }
}

class SelectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('selections')->insert([
            'byUserId' => '1',
            'selectedId' => '2',
            'selectionType' => 'User',
        ]);
        DB::table('selections')->insert([
            'byUserId' => '1',
            'selectedId' => '2',
            'selectionType' => 'Role',
        ]);
    }
}

class SubteamRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subteam_requests')->insert([
            'reportedBySubteam' => 1,
            'needMorePeople' => false,
            'needBiggerBudget' => true,
        ]);
        DB::table('subteam_requests')->insert([
            'reportedBySubteam' => 2,
            'needMorePeople' => false,
            'needBiggerBudget' => true,
        ]);
    }
}

class SubteamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subteams')->insert([
            'name' => 'IT',
            'description' => 'IT description',
            'numberofpeople' => 5,
        ]);
        DB::table('subteams')->insert([
            'name' => 'Music',
            'description' => 'Music description',
            'numberofpeople' => 7,
        ]);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'Alice',
            'password' => 'secret1',
            'role' => 2,
        ]);
        DB::table('users')->insert([
            'username' => 'Bob',
            'password' => 'secret2',
            'role' => 1,
        ]);
    }
}

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'first_name' => 'Alice',
            'last_name' => 'Brown',
            'phone' => '123123123',
            'user_id' => 1,
        ]);
        DB::table('employees')->insert([
            'first_name' => 'Bob',
            'last_name' => 'Green',
            'phone' => '321321321',
            'user_id' => 2,
        ]);
    }
}
