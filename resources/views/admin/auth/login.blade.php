<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Undangan Pernikahan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#1C1514] min-h-screen flex items-center justify-center p-4 font-sans text-gray-800">

    <div class="max-w-md w-full bg-[#FFF0E5] rounded-3xl shadow-2xl p-8 border border-[#B89C7A]/40 relative overflow-hidden">
        <!-- Top Ornament -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-[#753230] border-2 border-[#B89C7A] flex items-center justify-center text-[#FFF0E5]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="font-serif text-3xl font-bold text-[#753230]">Panel Admin</h1>
            <p class="text-xs text-[#5E6060] mt-1">Masuk untuk mengelola data undangan pernikahan</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-xl bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-rose-100 border border-rose-300 text-rose-800 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold text-[#753230] mb-1.5">Email Pengguna</label>
                <input type="text" id="email" name="email" value="{{ old('email', 'admin@gmail.com') }}" required autofocus
                       placeholder="admin@gmail.com"
                       class="w-full px-4 py-2.5 rounded-xl border border-[#B89C7A]/50 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#753230]">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-[#753230] mb-1.5">Kata Sandi</label>
                <input type="password" id="password" name="password" required value="admin123"
                       placeholder="••••••••"
                       class="w-full px-4 py-2.5 rounded-xl border border-[#B89C7A]/50 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[#753230]">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-[#5E6060]">
                    <input type="checkbox" name="remember" class="rounded text-[#753230] focus:ring-[#753230]">
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-3 rounded-xl bg-[#753230] text-[#FFF0E5] font-semibold text-sm tracking-wider uppercase border border-[#B89C7A] hover:bg-[#8E3A37] shadow-lg transition-all">
                Masuk ke Dashboard
            </button>
        </form>

        <!-- Help Info Box -->
        <div class="mt-8 pt-4 border-t border-[#B89C7A]/30 text-center">
            <p class="text-[11px] text-[#753230] font-medium">Akun bawaan default:</p>
            <p class="text-[11px] text-[#5E6060]">Email: <code class="bg-[#FAF4F4] px-1 py-0.5 rounded border border-[#B89C7A]/30 font-bold">admin@gmail.com</code> | Sandi: <code class="bg-[#FAF4F4] px-1 py-0.5 rounded border border-[#B89C7A]/30 font-bold">admin123</code></p>
            <div class="mt-3">
                <a href="{{ route('invitation.index') }}" class="text-xs text-[#753230] hover:underline font-semibold">
                    ← Kembali ke Halaman Undangan
                </a>
            </div>
        </div>
    </div>

</body>
</html>
