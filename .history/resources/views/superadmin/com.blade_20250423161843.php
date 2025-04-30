@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="fixed inset-0 bg-cover bg-center z-0" style="background-image: url('/image/naftalBg.jpeg'); filter: blur(6px);"></div>

    <div class="relative z-10 min-h-screen p-6 pb-16">
        <div class="bg-white/70 backdrop-blur-lg shadow-2xl rounded-2xl p-8 max-w-7xl mx-auto mt-8 transition-all duration-500 transform hover:scale-[1.01]">
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-900">
                    Structure Commerciale
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Agence -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-building text-white text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-white text-center">Agence</h2>
                    </div>
                    <div class="p-4">
                        <a href="#" class="block text-center py-2 px-4 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            Gérer les Agences
                        </a>
                    </div>
                </div>

                <!-- LP -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-gas-pump text-white text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-white text-center">LP</h2>
                    </div>
                    <div class="p-4">
                        <a href="#" class="block text-center py-2 px-4 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors duration-200">
                            Gérer les LP
                        </a>
                    </div>
                </div>

                <!-- CDD -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-4">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-store text-white text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-white text-center">CDD</h2>
                    </div>
                    <div class="p-4">
                        <a href="#" class="block text-center py-2 px-4 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors duration-200">
                            Gérer les CDD
                        </a>
                    </div>
                </div>

                <!-- GD -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                        <div class="flex items-center justify-center mb-2">
                            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                <i class="fas fa-warehouse text-white text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-white text-center">GD</h2>
                    </div>
                    <div class="p-4">
                        <a href="#" class="block text-center py-2 px-4 bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                            Gérer les GD
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
