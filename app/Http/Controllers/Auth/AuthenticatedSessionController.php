<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (session()->has('cart')) {
            $cartItems = session()->get('cart');

            foreach ($cartItems as $item) {

                $existingCartItem = Cart::where('user_id', Auth::id())
                                        ->where('product_id', $item['product_id'])
                                        ->first();

                if ($existingCartItem) {

                    $existingCartItem->quantity += $item['quantity'];
                    $existingCartItem->save();
                } else {

                    Cart::create([
                        'user_id' => Auth::id(),
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                    ]);
                }

            }
            session()->forget('cart');
        }

        return redirect()->route('customer.home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/shop');
    }
}
