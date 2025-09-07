<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor;

class VendorAuthController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('vendor.register'); // create this Blade file
    }

    /**
     * Handle vendor registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|string|min:6|confirmed',
            'business_name' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'about' => 'nullable|string',
        ]);

        // Create vendor
        $vendor = Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'business_name' => $request->business_name,
            'service_type' => $request->service_type,
            'address' => $request->address,
            'phone' => $request->phone,
            'about' => $request->about,
            'status' => 'active', // default value
        ]);

        // Login vendor
        Auth::guard('vendor')->login($vendor);

        return redirect()->route('vendor.dashboard')->with('success', 'Registration successful!');
    }

    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('vendor.login'); // create this Blade file
    }

    /**
     * Handle vendor login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->route('vendor.dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Handle vendor logout
     */
    public function logout(Request $request)
    {
        Auth::guard('vendor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('vendor.login')->with('success', 'Logged out successfully!');
    }
}
