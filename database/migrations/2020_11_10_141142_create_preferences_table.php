<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferences', function(Blueprint $table) {
            $table->id();
            $table->string('hue_client_id')->nullable();
            $table->string('hue_client_secret')->nullable();
            $table->string('hue_device_id')->nullable();

            $table->string('hue_username')->nullable();
            $table->string('hue_access_token')->nullable();
            $table->string('hue_access_token_expires_in')->nullable();
            $table->string('hue_access_token_expires_at')->nullable();
            $table->string('hue_refresh_token')->nullable();
            $table->string('hue_refresh_token_expires_in')->nullable();
            $table->string('hue_refresh_token_expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preferences');
    }
}
