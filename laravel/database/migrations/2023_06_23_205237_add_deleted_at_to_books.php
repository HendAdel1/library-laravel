use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToBooks extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}