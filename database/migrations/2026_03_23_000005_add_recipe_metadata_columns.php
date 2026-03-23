<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreignId('region_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->foreignId('dish_type_id')->nullable()->after('region_id')->constrained()->nullOnDelete();
            $table->text('summary')->nullable()->after('title');
            $table->unsignedInteger('prep_time')->nullable()->after('cooking_time');
            $table->unsignedInteger('servings')->nullable()->after('prep_time');
            $table->string('difficulty')->nullable()->after('servings');
            $table->string('video_url')->nullable()->after('image_path');
            $table->string('status')->default('published')->after('video_url');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('region_id');
            $table->dropConstrainedForeignId('dish_type_id');
            $table->dropColumn([
                'summary',
                'prep_time',
                'servings',
                'difficulty',
                'video_url',
                'status',
            ]);
        });
    }
};