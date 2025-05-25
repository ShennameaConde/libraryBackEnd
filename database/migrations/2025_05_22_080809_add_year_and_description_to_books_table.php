<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('books', function (Blueprint $table) {
        $table->string('publisher')->nullable()->after('description');
        $table->string('isbn')->unique()->nullable()->after('publisher');
    });
}

public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropColumn(['publisher', 'isbn']);
    });
}
};