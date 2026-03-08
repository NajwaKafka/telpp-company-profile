<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TeLpp - Internal Gateway</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Shippori+Mincho+B1:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-['Inter'] bg-slate-950 text-white antialiased min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Sophisticated Background -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-slate-800/30 blur-[120px] rounded-full"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\" fill-rule=\"evenodd\"%3E%3Ccircle cx=\"3\" cy=\"3\" r=\"0.5\"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="w-full max-w-md px-6 relative z-10">
        <!-- Logo & Brand -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center size-20 bg-primary ring-8 ring-primary/10 rounded-[2rem] shadow-2xl shadow-primary/20 mb-8 transform transition-transform hover:scale-110 duration-500">
                <span class="material-symbols-outlined text-white text-4xl">forest</span>
            </div>
            <h1 class="text-4xl font-black tracking-tighter mb-2">TeLpp Portal</h1>
            <p class="text-slate-500 text-xs font-black uppercase tracking-[0.4em]">Corporate Management System</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white/5 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden group">
            <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-50 group-hover:opacity-100 transition-opacity"></div>
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-8">
                @csrf
                
                @if ($errors->any())
                    <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-500 text-sm font-bold">error</span>
                        <p class="text-[10px] font-black uppercase text-red-500 tracking-widest">Authentication Failed</p>
                    </div>
                @endif

                <!-- Email -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-1">Credential ID</label>
                    <div class="relative group/input">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-600 group-focus-within/input:text-primary transition-colors">alternate_email</span>
                        <input type="email" name="email" required autofocus
                            class="w-full bg-white/5 border border-white/5 text-white text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white/10 focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all outline-none"
                            placeholder="user@telpp.com">
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 ml-1">Security Key</label>
                    <div class="relative group/input">
                        <span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-600 group-focus-within/input:text-primary transition-colors">lock</span>
                        <input type="password" name="password" required
                            class="w-full bg-white/5 border border-white/5 text-white text-sm font-bold rounded-2xl pl-16 pr-8 py-5 focus:bg-white/10 focus:border-primary/50 focus:ring-4 focus:ring-primary/5 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between px-2">
                    <label class="flex items-center gap-3 cursor-pointer group/check">
                        <input type="checkbox" name="remember" class="hidden peer">
                        <div class="size-5 border-2 border-slate-700 rounded-lg flex items-center justify-center transition-all peer-checked:bg-primary peer-checked:border-primary group-hover/check:border-slate-500">
                            <span class="material-symbols-outlined text-white text-xs font-black opacity-0 peer-checked:opacity-100 transition-opacity">check</span>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-[0.1em] text-slate-500 group-hover/check:text-slate-300">Keep Session</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white py-6 rounded-2xl font-black text-xs uppercase tracking-[0.3em] shadow-xl shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3">
                    Authorized Access
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center">
            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.4em]">TeLpp Dynamic Portal &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
