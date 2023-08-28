<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->foreignId('user_id') //lưu trữ khóa ngoại (foreign key) trỏ tới bảng "users".
                ->references('id') ->on('users') //thiết lập quan hệ khóa ngoại giữa cột "user_id" và khóa chính "id" của bảng "users".
                ->constrained() //phương thức để thiết lập các ràng buộc (constraints) cho khóa ngoại.
                ->onDelete('cascade')->onUpdate('cascade'); //Đây là các phương thức để thiết lập hành động khi xóa hoặc cập nhật khóa chính của bảng "users".
                //Trong trường hợp này, khi một người dùng bị xóa hoặc cập nhật,
                // tất cả các khoản gửi liên quan đến người dùng đó cũng sẽ bị xóa hoặc cập nhật tương ứng.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
