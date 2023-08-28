<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tạo mới mt người dùng
        $user = User::create([
            'name' => 'Hoàng Thanh Tùng',
            'email' => 'tungg2302@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        //một vai trò mới được tạo bằng cách gọi phương thức create() trên model Role.
        //Vai trò này có tên là Admin
        $role = Role::create(['name' => 'Admin']);

       //Lấy tất cả các quyền trong bảng permission trên CSDL bằng cách dùng phương thức pluck() trên model Permission

        $permissions = Permission::pluck('id', 'id')->all();
        //Lúc này vai trò 'Admin' được đồng bộ hóa với tập hợp các quyền bằng
        // cách gọi phương thức syncPermission()
        $role->syncPermissions($permissions);
        // Người dùng mới được gán vai trò 'Admin' bằng cách gọi phương thức assignRole() trên trường dùng
        //và truyền vào danh sách ID quyền
        $user->assignRole([$role->id]);

        //Truyền cho người dùng mới với vai trò Admin, vai trò Admin này có tất cả các quyền có sẵn trên hệ thống
    }
}
