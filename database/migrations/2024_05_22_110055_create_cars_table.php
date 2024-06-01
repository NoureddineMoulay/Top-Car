    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateCarsTable extends Migration
    {
        public function up()
        {
            Schema::create('cars', function (Blueprint $table) {
                $table->id();
                $table->string('make');
                $table->string('model');
                $table->year('year');
                $table->string('location');
                $table->string('description')->nullable();
                $table->string('car_image')->nullable();
                $table->decimal('rental_price_per_day', 8, 2);
                $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
                $table->integer('number_of_seats');
                $table->enum('transmission', ['automatic', 'manual']);
                $table->enum('fuel_type', ['gazoil', 'petrol', 'electric', 'hybrid']);
                $table->integer('consumption');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('cars');
        }
    }
