<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDATION FOR FILE UPLOAD
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        // ✅ HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        Recipe::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect('/dashboard')->with('success', 'Recipe added!');
    }

    public function destroy($id)
    {
        $recipe = Recipe::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($recipe) {

            // ✅ DELETE IMAGE FILE IF EXISTS
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }

            $recipe->delete();
        }

        return redirect('/dashboard')->with('success', 'Recipe deleted!');
    }
}
