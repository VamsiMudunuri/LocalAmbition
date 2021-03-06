<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    protected $connection;
    private $table = 'places';

    public function __construct() {
        $this->connection = Config::get('database.connections.mongodb.driver');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::connection($this->connection)->create($this->table, function (Blueprint $table) {


            $table->index(['model' => 1, 'model_id' => -1]);

            $table->index(
                [
                    'name' => 'text',
                    'address' => 'text',
                    'address_or_name' => 'text'
                ],
                null,
                null,
                [
                    'weights' =>
                        [
                            'name' => 10,
                            'address' => 7,
                            'address_or_name' => 10
                        ]
                ]
            );

            $table->index('action');
            $table->index('city');
            $table->index('state_code');
            $table->index('state_name');
            $table->index('postal_code');
            $table->index('country_code');
            $table->index('country_name');
            $table->index('continent');
            $table->index('ip');
            $table->index(array('geo' => '2dsphere'));
            $table->index(['creator' => 1, 'editor' => -1]);
            $table->index(['created_at' => 1]);
            $table->index(['updated_at' => 1]);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::connection($this->connection)->drop($this->table);
    }
}
