<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centres Naftal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        fadeIn: "fadeIn 1s ease-out",
                        pulse: "pulse 2s infinite",
                    },
                    keyframes: {
                        fadeIn: {
                            "0%": { opacity: "0", transform: "translateY(-10px)" },
                            "100%": { opacity: "1", transform: "translateY(0)" }
                        },
                        pulse: {
                            "0%, 100%": { transform: "scale(1)" },
                            "50%": { transform: "scale(1.05)" }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: url('/image/naftalBg.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-white bg-opacity-20 backdrop-blur-md">

    <div class="overlay min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white bg-opacity-20 backdrop-blur-md py-4 px-6 fixed top-0 left-0 w-full z-50 animate-fadeIn">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <!-- Search Bar -->
        <div class="relative w-64">
            <input type="text" placeholder="Rechercher..." 
                class="w-full pl-12 pr-4 py-2 rounded-xl bg-gray-200 border border-gray-300 text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 shadow-sm transition-all duration-300">
            <div class="absolute left-4 top-2.5 text-gray-500">
                <!-- Search Icon -->
            </div>
        </div>

        <!-- Buttons Group -->
        <div class="flex items-center gap-4">
            <a href="{{ route('informations') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-5 py-2 rounded-lg shadow-md transition-all duration-300 hover:scale-105">
               Informations
            </a>

            <a href="{{ route('admin.users.create') }}"
               class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg shadow-md transition-all duration-300 hover:scale-105 animate-pulse">
               Créer un compte
            </a>

            <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg shadow-md transition-all duration-300 hover:scale-105 animate-pulse">
                {{ Auth::user()->role }}
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg shadow-md transition-all duration-300 hover:scale-105">
                    Déconnecter
                </button>
            </form>
        </div>
    </div>
</header>


        <!-- Main Content -->
        <div class="flex flex-col items-center justify-center flex-grow pt-24">
            
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <img src="/image/naftal logo.webp" alt="Logo Naftal" class="h-28 shadow-md rounded-lg hover:animate-pulse">
            </div>

            <!-- Centers Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                
                <!-- SIAGE -->
                <a href="#" class="transform transition-all duration-500 hover:scale-105 hover:shadow-2xl animate-fadeIn">
                    <div class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-full shadow-2xl flex items-center justify-center w-48 h-24 transition-all duration-300">
                        <h3 class="text-lg font-semibold tracking-wide text-center">SIEGE</h3>
                    </div>
                </a>

                <!-- AIN-OUSSARA -->
                <a href="#" class="transform transition-all duration-500 hover:scale-105 hover:shadow-2xl animate-fadeIn">
                    <div class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-full shadow-2xl flex items-center justify-center w-48 h-24 transition-all duration-300">
                        <h3 class="text-lg font-semibold tracking-wide text-center">AIN-OUSSARA</h3>
                    </div>
                </a>

                <!-- DJELFA -->
                <a href="#" class="transform transition-all duration-500 hover:scale-105 hover:shadow-2xl animate-fadeIn">
                    <div class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-full shadow-2xl flex items-center justify-center w-48 h-24 transition-all duration-300">
                        <h3 class="text-lg font-semibold tracking-wide text-center">DJELFA</h3>
                    </div>
                </a>

                <!-- CHIFFA -->
                <a href="#" class="transform transition-all duration-500 hover:scale-105 hover:shadow-2xl animate-fadeIn">
                    <div class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 rounded-full shadow-2xl flex items-center justify-center w-48 h-24 transition-all duration-300">
                        <h3 class="text-lg font-semibold tracking-wide text-center">CHIFFA</h3>
                    </div>
                </a>
                
            </div>
        </div>

    </div>

</body>
</html>
