<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_group = new \App\Model\Users\UserGroup();
        $user_group->name = 'Administrator';
        $user_group->permission = json_encode([
            'backend.user.group.lists',
            'backend.user.group.add',
            'backend.user.group.added',
            'backend.user.group.edit',
            'backend.user.group.edited',
            'backend.user.group.remove'
        ]);
        $user_group->save();
    }
}
