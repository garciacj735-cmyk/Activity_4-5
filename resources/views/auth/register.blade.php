<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ERROR DISPLAY -->
        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <x-input-label for="full_name" value="Full Name" />
            <x-text-input id="full_name" class="block mt-1 w-full"
                type="text" name="full_name" required />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" required />
        </div>

        <div class="mt-4">
            <x-input-label for="role" value="Role" />
            <select name="role" class="block mt-1 w-full">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
