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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->integer('price')->nullable(false);
            //$table->string('is_admin')->always('user');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('master_id')->constrained();
            // CONSTRAINT - ключевое слово, которое указывает, что в данной секции описывается ограничение, 
            // которое налагается на данные в таблице, и которое будет проверяться подсистемой контроля целостности 
            // и непротиворечивости данных сервера, что в свою очередь не позволит внести или изменить данные в таблице так, 
            // чтобы это условие не выполнялось, а при выявлении факта наличия не соответствующих этому условию 
            // данных в таблице она будет считаться повреждённой. 
            // Сразу после этого ключевого слова указывается уникальный идентификатор (имя) этого ограничения 
            // (он может быть пропущен, тогда сервер сгенерирует его автоматически).

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
