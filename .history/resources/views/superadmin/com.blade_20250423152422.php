@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="fixed inset-0 bg-cover bg-center z-0" style="background-image: url('/image/naftalBg.jpeg'); filter: blur(6px);"></div>

    <div class="relative z-10 min-h-screen p-6 pb-16">
        <div class="bg-white/70 backdrop-blur-lg shadow-2xl rounded-2xl p-8 max-w-7xl mx-auto mt-8 transition-all duration-500 transform hover:scale-[1.01]">
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-900">
                    Sites Groupés par Branche – <span class="text-yellow-600">Commercial</span>
                </h1>
            </div>

            <div class="mb-6 bg-white/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-4 border-b border-gray-200/50 bg-white/50">
                    <h2 class="font-semibold text-blue-900">Commercial</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @if(isset($details) && !empty($details))
            @foreach ($details as $key => $subBranch)
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded-xl shadow-md p-6 flex flex-col items-center justify-center h-full transition-all duration-300 transform hover:scale-105 relative overflow-hidden group">
                    <div class="absolute -top-4 -right-4 h-16 w-16 rounded-full bg-white/10 transform rotate-45 translate-x-8 translate-y-8 group-hover:translate-x-0 group-hover:translate-y-0 transition-transform duration-500"></div>
                    <div class="h-16 w-16 bg-white/20 rounded-full flex items-center justify-center mb-4 transform group-hover:scale-110 transition-all duration-300 z-10">
                        <i class="fas fa-map-marker-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-lg font-semibold tracking-wide text-center z-10">{{ ucfirst($key) }}</h3>
                    <!-- Afficher les données associées à chaque sous-structure -->
                    @foreach ($subBranch as $item)
                        <p>{{ $item }}</p> <!-- Remplacer par ce que tu souhaites afficher -->
                    @endforeach
                </div>
            @endforeach
        @else
            <p>Aucune donnée disponible.</p>
        @endif
            </div>
       
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection