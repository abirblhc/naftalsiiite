@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="fixed inset-0 bg-cover bg-center z-0" style="background-image: url('/image/naftalBg.jpeg'); filter: blur(6px);"></div>

    <div class="relative z-10 min-h-screen p-6 pb-16">
        <div class="bg-white/70 backdrop-blur-lg shadow-2xl rounded-2xl p-8 max-w-7xl mx-auto mt-8 transition-all duration-500 transform hover:scale-[1.01]">
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-blue-900">
                    Sites Groupés par Branche – <span class="text-green-600">Commercial</span>
                </h1>
            </div>

            <div class="mb-6 bg-white/80 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="p-4 border-b border-gray-200/50 bg-white/50">
                    <h2 class="font-semibold text-blue-900">Détails Commerciaux par Site</h2>
                </div>
                <div class="p-6">
                    @if(count($branchDetails) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($branchDetails as $siteName => $data)
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 p-4">
                                        <h3 class="text-lg font-semibold text-white">{{ $siteName }}</h3>
                                    </div>
                                    <div class="p-4">
                                        @if(count($data['details']) > 0)
                                            <div class="space-y-3">
                                                @foreach ($data['details'] as $type => $value)
                                                    @if($value)
                                                        <div class="flex items-center space-x-2">
                                                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                                @switch($type)
                                                                    @case('agence')
                                                                        <i class="fas fa-building text-green-600"></i>
                                                                        @break
                                                                    @case('LP')
                                                                        <i class="fas fa-gas-pump text-green-600"></i>
                                                                        @break
                                                                    @case('CDD')
                                                                        <i class="fas fa-store text-green-600"></i>
                                                                        @break
                                                                    @case('GD')
                                                                        <i class="fas fa-warehouse text-green-600"></i>
                                                                        @break
                                                                @endswitch
                                                            </div>
                                                            <div>
                                                                <span class="font-medium text-gray-700">{{ $type }}:</span>
                                                                <span class="text-gray-600">{{ $value }}</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-gray-500 text-center py-4">Aucun détail commercial disponible</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-store text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-gray-500 text-lg">Aucune branche commerciale trouvée</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
