<x-app-layout>
    <div style="max-width:600px; margin:auto; padding:20px;">

        <h1 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
            ➕ Add New Recipe
        </h1>

        @if ($errors->any())
            <div style="background:#f8d7da; padding:10px; margin-bottom:15px; border-radius:5px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ✅ IMPORTANT: enctype added -->
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Recipe Title</label><br>
                <input type="text" name="title" required
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
            </div>

            <div style="margin-bottom:15px;">
                <label style="font-weight:bold;">Category</label><br>
                <input type="text" name="category"
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
            </div>

            <!-- ✅ CHANGED: file upload instead of URL -->
            <div style="margin-bottom:20px;">
                <label style="font-weight:bold;">Upload Image</label><br>
                <input type="file" name="image"
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
            </div>

            <button type="submit"
                style="padding:10px; background:green; color:white; border:none; border-radius:5px;">
                Save Recipe
            </button>

        </form>

    </div>
</x-app-layout>
