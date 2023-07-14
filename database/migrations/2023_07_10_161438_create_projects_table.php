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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->string('title', 50);
            $table->string('slug', 50)->unique();
            $table->date('creation_date');
            $table->date('last_update');
            $table->string('author', 30);
            $table->string('collaborators', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('link_github', 150);


            //metterlo quando si crea il cestino
            $table->softDeletes();

            $table->timestamps();

            //definire la colonna come chiave esterna
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign');
            $table->dropColumn('type_id');
        });

        Schema::dropIfExists('projects');
    }
};
