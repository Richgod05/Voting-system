<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('level')->default('no level provided');
            $table->string('programme')->default('no programme provided');
            $table->text('manifesto')->default('No manifesto provided');
            $table->string('status')->default('Disqualified');
            $table->string('image')->default('profile.png'); // path to uploaded image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};