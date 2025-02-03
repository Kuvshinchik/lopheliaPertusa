@php
use Illuminate\Support\Facades\DB;

// Test database connection
try {
    DB::connection()->getPdo();
	dd(11111);
} catch (\Exception $e) {
	dd("Could not connect to the database.  Please check your configuration. error:" . $e );
//    die("Could not connect to the database.  Please check your configuration. error:" . $e );
}
@endphp