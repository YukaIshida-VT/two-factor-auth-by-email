<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwoFactorAuthByEmailTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('two_factor_auth_by_email_table', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->comment('新しいメールアドレス');
            $table->string('auth_code')->comment('認証コード');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('two_factor_auth_by_email_table');
    }
}