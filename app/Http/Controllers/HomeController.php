<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstagramService;
use App\Models\HeroSlide;
use App\Models\BusinessProfile;
use App\Models\Service;

class HomeController extends Controller
{
    public function index(InstagramService $instagram)
    {
        $instagramFeed = $instagram->getFeed(6);
        $slides = HeroSlide::where('is_active', true)->orderBy('display_order')->get();
        $profile = BusinessProfile::firstOrCreate(['id' => 'default']);
        $onlinePaymentsActive = $profile->payment_gateway_enabled || $profile->show_prices;
        
        // Get services with base prices for the pricing cards
        $services = Service::with('vehicleTypes')->where('is_active', true)->orderBy('display_order')->get()->keyBy('slug');
        
        return view('home', compact('instagramFeed', 'slides', 'profile', 'onlinePaymentsActive', 'services'));
    }
}
