<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
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
//            $table->string('name');
            $table->boolean('is_supplied')->nullable()->default(0);
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
        Schema::dropIfExists('products');
    }
}
