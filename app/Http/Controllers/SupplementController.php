use App\Http\Controllers\SupplementController;
use Illuminate\Http\Request;

class SupplementController extends Controller
{
    public function index()
    {
        $supplements = Supplement::all();
        return view('supplements.index', compact('supplements'));
    }

    public function create()
    {
        return view('supplements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'dosage' => 'required',
            'schedule' => 'required'
        ]);

        Supplement::create($request->all());

        return redirect()->route('supplements.index')->with('success', 'Suplemen berhasil ditambahkan!');
    }

    public function destroy(Supplement $supplement)
    {
        $supplement->delete();
        return redirect()->route('supplements.index')->with('success', 'Suplemen berhasil dihapus.');
    }
}
