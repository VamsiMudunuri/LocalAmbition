<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBioBusinessOpportunitiesTable extends Migration
{
    protected $connection;
    private $table = 'bio_business_opportunities';

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
            $table->unique('user_id');
            $table->index(
                [
                    'opportunities' => 'text'
                ],
                null,
                null,
                [
                    'weights' =>
                        [
                            'opportunities' => 10
                        ]
                ]
            );
            $table->index(['types' => 1]);
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
