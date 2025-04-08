namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showForm()
    {
        return view('auth.signup');
    }

    public function processForm(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Simulasi pembuatan akun
        // Biasanya di sini kita pakai User::create([...])

        return back()->with('success', 'Account created successfully!');
    }
}