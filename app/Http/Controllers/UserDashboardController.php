<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $images = $user->images()->latest()->get(); // Fetch latest images
        $imageCount = $user->images()->count();
        return view('user.dashboard', compact('images', 'imageCount'));
    }
}