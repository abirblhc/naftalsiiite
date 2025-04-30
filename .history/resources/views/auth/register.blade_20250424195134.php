<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Naftal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="relative">
    <div class="fixed inset-0 bg-cover bg-center z-0" style="background-image: url('/image/naftalBg.jpeg'); filter: blur(6px);"></div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-4">
        <div class="relative z-10 flex justify-center mb-8">
            <img src="/image/naftal logo.webp" class="w-24 h-auto">
        </div>

        <div class="bg-white/70 backdrop-blur-xl shadow-2xl rounded-2xl p-6 md:p-8 max-w-md w-full">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Nom</label>
                    <input id="name" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                           type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Email</label>
                    <input id="email" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                           type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Site -->
                <div>
                    <label for="site_id" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Site</label>
                    <select id="site_id" name="site_id" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                        <option value="">Sélectionnez un site</option>
                        @foreach($sites as $site)
                            <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>
                                {{ $site->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('site_id')" class="mt-2" />
                </div>

                <!-- Branche -->
                <div>
                    <label for="branche_name" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Branche</label>
                    <select id="branche_name" name="branche_name" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                        <option value="">Sélectionnez une branche</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->name }}" {{ old('branche_name') == $branch->name ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('branche_name')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Mot de passe</label>
                    <input id="password" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                           type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm md:text-base font-bold text-gray-900 mb-2">Confirmer le mot de passe</label>
                    <input id="password_confirmation" class="block w-full px-4 py-3 border-2 border-blue-400 rounded-xl bg-white/90 focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                           type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-blue-600 hover:text-blue-800 hover:underline" href="{{ route('login') }}">
                        Déjà inscrit ?
                    </a>

                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition duration-300 transform hover:scale-105">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
