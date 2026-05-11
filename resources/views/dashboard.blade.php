<x-app-layout>
    <div style="max-width:1200px; margin:auto; padding:20px;">

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:5px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <h1 style="font-size:26px; font-weight:bold; margin-bottom:20px;">
            🍽 Recipe Dashboard
        </h1>

        <!-- USER INFO -->
        <div style="border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:20px; background:#f9f9f9;">
            <h2 style="font-size:16px; font-weight:bold; margin-bottom:5px;">User Info</h2>
            <p><strong>Name:</strong> {{ $user->full_name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        <!-- ✅ NEW: USERS FROM YOUR API -->
        <div style="border:1px solid #ddd; padding:15px; border-radius:8px; margin-bottom:20px; background:#fff;">
            <h2 style="font-size:16px; font-weight:bold; margin-bottom:10px;">
                All Users (From API)
            </h2>

            @forelse($users ?? [] as $u)
                <p style="font-size:14px;">
                    {{ $u['full_name'] ?? 'N/A' }} — {{ $u['email'] ?? 'N/A' }}
                </p>
            @empty
                <p>No users found.</p>
            @endforelse
        </div>

        <!-- ADD + SEARCH -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">

            <a href="{{ route('recipes.create') }}" 
               style="background:green; color:white; padding:10px 15px; border-radius:5px; text-decoration:none;">
                + Add Recipe
            </a>

            <!-- SEARCH -->
            <form method="GET">
                <input type="text" name="search" placeholder="Search recipes..."
                    style="padding:6px; border:1px solid #ccc; border-radius:4px;">
                <button type="submit"
                    style="padding:6px 10px; background:#3490dc; color:white; border:none; border-radius:4px;">
                    Search
                </button>
            </form>

        </div>

        <!-- YOUR RECIPES -->
        <div style="margin-bottom:30px;">
            <h2 style="font-size:18px; font-weight:bold; margin-bottom:10px;">
                Your Recipes
            </h2>

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px;">
                @forelse($recipes as $r)
                    <div style="border:1px solid #ddd; border-radius:8px; overflow:hidden; background:white;">

                        <img src="{{ $r->image ? asset('storage/' . $r->image) : 'https://via.placeholder.com/300' }}"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/300';"
                             style="width:100%; height:120px; object-fit:cover;">

                        <div style="padding:10px;">
                            <p style="font-size:14px; font-weight:bold;">
                                {{ $r->title }}
                            </p>
                            <p style="font-size:12px; color:gray;">
                                {{ $r->category }}
                            </p>

                            <form method="POST" action="{{ route('recipes.delete', $r->id) }}" style="margin-top:8px;">
                                @csrf
                                @method('DELETE')
                                <button style="background:red; color:white; border:none; padding:5px 8px; border-radius:4px;">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <p>No recipes yet.</p>
                @endforelse
            </div>
        </div>

        <!-- SUGGESTED RECIPES -->
        <div>
            <h2 style="font-size:18px; font-weight:bold; margin-bottom:10px;">
                Suggested Recipes
            </h2>

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px;">
                @forelse($external['meals'] ?? [] as $meal)
                    <div style="border:1px solid #ddd; border-radius:8px; overflow:hidden; background:white;">

                        <img src="{{ $meal['strMealThumb'] }}"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/300';"
                             style="width:100%; height:120px; object-fit:cover;">

                        <div style="padding:10px;">
                            <a href="https://www.themealdb.com/meal/{{ $meal['idMeal'] }}" 
                               target="_blank" 
                               style="text-decoration:none; color:black;">
                                <p style="font-size:14px; font-weight:bold;">
                                    {{ $meal['strMeal'] }}
                                </p>
                            </a>
                        </div>

                    </div>
                @empty
                    <p>No API data available.</p>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
