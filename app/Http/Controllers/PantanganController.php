namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pantangan;

class PantanganController extends Controller
{
    public function index()
    {
        // Ambil semua pantangan dari database
        $pantangan = Pantangan::all();

        // Kelompokkan berdasarkan kategori
        $kategoriCounts = [
            'Alergi' => $pantangan->where('kategori', 'Alergi')->count(),
            'Kesehatan' => $pantangan->where('kategori', 'Kesehatan')->count(),
            'Diet' => $pantangan->where('kategori', 'Diet')->count(),
        ];

        return view('pantangan.index', compact('pantangan', 'kategoriCounts'));
    }
}
