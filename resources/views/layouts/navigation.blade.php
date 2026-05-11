<nav style="background:#1f2937; padding:15px; color:white;">

    <div style="max-width:1200px; margin:auto; display:flex; justify-content:space-between; align-items:center;">

        <!-- LEFT: APP NAME -->
        <div style="font-size:20px; font-weight:bold;">
            🍽 Recipe Saver
        </div>

        <!-- CENTER: NAV -->
        <div>
            <a href="/dashboard" style="color:white; margin-right:20px; text-decoration:none;">
                Dashboard
            </a>
        </div>

        <!-- RIGHT: USER -->
        <div>
            <span style="margin-right:10px;">
                {{ Auth::user()->full_name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:red; color:white; border:none; padding:5px 10px; border-radius:5px;">
                    Logout
                </button>
            </form>
        </div>

    </div>

</nav>
