<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

               //php artisan db:seed --class=PermissionTableSeeder
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tạo mảng $permission chứa các quyền
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];
        // Foreach lặp mảng
        //$permission được sử dụng để lưu trữ giá trị của mỗi phần tử trong mảng $permissions.
        foreach ($permissions as $permission){
            //phương thức create của class Permission được gọi để tạo một bản ghi mới trong CSDL
            Permission::create(['name'=> $permission]);
        }
    }
}
