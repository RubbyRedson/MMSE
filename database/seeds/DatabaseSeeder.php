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
        $this->call(SubteamRequestStatusTableSeeder::class);  // SubteamRequestStatus must be before SubteamRequest
        $this->call(SubteamRequestsTableSeeder::class); // SubteamRequests must be after Subteams and after Projects

        $this->call(PlanningRequestStatusTableSeeder::class);  // PlanningRequestStatus must be before PlanningRequest
        $this->call(PlanningRequestsTableSeeder::class);
        $this->call(ResourceRequestSeeder::class);
    }
}

class ResourceRequestSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resource_requests')->insert([
            'project' => 1,
            'approved' => false,
            'proposal' => 200,
            'type' => 'budget'
        ]);

        DB::table('resource_requests')->insert([
            'project' => 1,
            'approved' => false,
            'proposal' => 300,
            'type' => 'people'
        ]);
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
            'tag' => 'customer_service',
        ]);
        DB::table('roles')->insert([
            'title' => 'Customer service manager',
            'description' => 'Description of Customer service manager',
            'auth' => 2,
            'tag' => 'customer_service_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'Financial manager',
            'description' => 'Description of Financial manager',
            'auth' => 3,
            'tag' => 'financial_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'Administration manager',
            'description' => 'Description of Administration manager',
            'auth' => 4,
            'tag' => 'administration_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'Production manager',
            'description' => 'Description of Production manager',
            'auth' => 5,
            'tag' => 'production_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'HR manager',
            'description' => 'Description of HR manager',
            'auth' => 6,
            'tag' => 'hr_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'HR team',
            'description' => 'Description of HR team',
            'auth' => 7,
            'tag' => 'hr_team',
        ]);
        DB::table('roles')->insert([
            'title' => 'Service manager',
            'description' => 'Description of Service manager',
            'auth' => 8,
            'tag' => 'service_manager',
        ]);
        DB::table('roles')->insert([
            'title' => 'Sub-team',
            'description' => 'Description of Sub-team',
            'auth' => 9,
            'tag' => 'sub_team',
        ]);
        DB::table('roles')->insert([
            'title' => 'Vice-president',
            'description' => 'Description of Vice-president',
            'auth' => 10,
            'tag' => 'vice_president',
        ]);
        DB::table('roles')->insert([
            'title' => 'Financial department',
            'description' => 'Description of Financial department',
            'auth' => 11,
            'tag' => 'financial_department',
        ]);
        DB::table('roles')->insert([
            'title' => 'Administration department',
            'description' => 'Description of Administration department',
            'auth' => 12,
            'tag' => 'administration_department',
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
            'status' => 1,
            'feedback' => 'Feedback for request 1',
            'description' => 'description for request 1',
            'proposed_budget' => 500,
        ]);
        DB::table('planning_requests')->insert([
            'client' => 2,
            'status' => 4,
            'feedback' => 'Feedback for request 2',
            'description' => 'description for request 2',
            'proposed_budget' => 700,
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
        DB::table('projects')->insert([
            'name' => 'Fika 2',
            'client' => 2,
            'description' => 'Fika 2 description',
            'cost' => 700,
            'start' => date('2008-11-13'),
            'stop' => date('2008-12-27'),
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
            'project' => 2,
            'status' => 1,
            'needMorePeople' => true,
            'needBiggerBudget' => true,
        ]);
        DB::table('subteam_requests')->insert([
            'reportedBySubteam' => 2,
            'project' => 1,
            'status' => 2,
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
    private function getSalt(){
        return bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $salt = $this->getSalt();
        DB::table('users')->insert([
            'username' => 'Alice',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 2,
        ]);
        DB::table('users')->insert([
            'username' => 'Bob',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 1,
        ]);


        DB::table('users')->insert([
            'username' => 'customer_service@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'customer_service_manager@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 2,
        ]);

        DB::table('users')->insert([
            'username' => 'financial_manager@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 3,
        ]);

        DB::table('users')->insert([
            'username' => 'administration_manager@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 4,
        ]);

        DB::table('users')->insert([
            'username' => 'department_manager@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 5,
        ]);

        DB::table('users')->insert([
            'username' => 'hr_team@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 7,
        ]);

        DB::table('users')->insert([
            'username' => 'sub_team@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 9,
        ]);

        DB::table('users')->insert([
            'username' => 'financial_department@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 11,
        ]);

        DB::table('users')->insert([
            'username' => 'administration_department@sep.com',
            'salt' => $salt,
            'password' => sha1($salt ."abc123"),
            'role' => 12,
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

class PlanningRequestStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planning_request_status')->insert([
            'status' => 'Pending Customer Manager Approval',
        ]);
        DB::table('planning_request_status')->insert([
            'status' => 'Pending Financial Manager Feedback',
        ]);
        DB::table('planning_request_status')->insert([
            'status' => 'Pending Administrative Manager Approval',
        ]);
        DB::table('planning_request_status')->insert([
            'status' => 'Approved',
        ]);
        DB::table('planning_request_status')->insert([
            'status' => 'Rejected',
        ]);
    }
}

class SubteamRequestStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subteam_request_status')->insert([
            'status' => 'Pending',
        ]);
        DB::table('subteam_request_status')->insert([
            'status' => 'Reviewed',
        ]);
        DB::table('subteam_request_status')->insert([
            'status' => 'Approved',
        ]);
        DB::table('subteam_request_status')->insert([
            'status' => 'Rejected',
        ]);
    }
}