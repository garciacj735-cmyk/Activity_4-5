<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User; // ✅ ADDED

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 🔍 SEARCH (SAFE + CLEAN)
        $search = $request->input('search');

        $recipes = Recipe::where('user_id', $user->id)
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        // 🌐 PUBLIC API (MealDB) WITH CACHE + FAILSAFE
        $external = Cache::remember('meals', 60, function () {

            try {
                $randomLetter = chr(rand(97, 122));

                $response = Http::withoutVerifying()
                    ->timeout(5)
                    ->get("https://www.themealdb.com/api/json/v1/1/search.php?s={$randomLetter}");

                if ($response->successful() && isset($response['meals']) && !empty($response['meals'])) {
                    return $response->json();
                }

            } catch (\Exception $e) {
                // fail silently
            }

            return [
                'meals' => [
                    [
                        'strMeal' => 'Chicken Handi',
                        'strMealThumb' => 'https://www.themealdb.com/images/media/meals/wyxwsp1486979827.jpg',
                        'idMeal' => '52795'
                    ],
                    [
                        'strMeal' => 'Beef Rendang',
                        'strMealThumb' => 'https://www.themealdb.com/images/media/meals/bc8v651619789840.jpg',
                        'idMeal' => '53013'
                    ],
                    [
                        'strMeal' => 'Kabsa',
                        'strMealThumb' => 'https://www.themealdb.com/images/media/meals/1529446352.jpg',
                        'idMeal' => '52815'
                    ]
                ]
            ];
        });

       
        $users = User::select('id', 'full_name', 'email')->get()->toArray();

        return view('dashboard', [
            'user' => $user,
            'recipes' => $recipes,
            'external' => $external,
            'users' => $users,
        ]);
    }
}
