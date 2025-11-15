<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoFactorCodesTable extends Migration
{
    public function up()
    {
        Schema::create('two_factor_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code');
            $table->timestamps();

            // Tạo khóa ngoại liên kết với bảng users (xóa mã nếu user bị xóa)
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('two_factor_codes');
    }
}
