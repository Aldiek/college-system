<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCouncilDecisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('council_decision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('council_id')->constrained()->onDelete('cascade');
            $table->foreignId('decision_id')->constrained()->onDelete('cascade');
            $table->string('final_decision')->nullable();
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
        Schema::dropIfExists('council_decision');
    }
}
