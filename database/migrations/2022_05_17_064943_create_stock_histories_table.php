<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('warehouse_id')
                ->constrained()
                 ->cascadeOnDelete()
                  ->cascadeOnUpdate();
            $table->foreignId('ingredient_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('supplier_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->float('amount');
            $table->string('unit');
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
        Schema::dropIfExists('stock_histories');
    }
};
