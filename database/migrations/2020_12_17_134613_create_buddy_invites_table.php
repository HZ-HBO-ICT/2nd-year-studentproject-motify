<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuddyInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buddy_invites', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('requested_by_user_id');
            $table->unsignedBigInteger('requested_user_id');

            $table->foreign('requested_by_user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('requested_user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->boolean('is_accepted')->default(false);

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
        Schema::dropIfExists('buddy_invites');
    }
}
