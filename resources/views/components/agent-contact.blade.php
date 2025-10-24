@props(['agent'])

<div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
    <h3 class="text-xl font-bold text-gray-900 mb-6">Property Agent</h3>
    
    <div class="text-center mb-6">
        @if($agent->photo)
            <img src="{{ asset('images/agent/' . $agent->photo) }}" alt="{{ $agent->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-gray-100">
        @else
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-gray-100">
                <i class="fas fa-user text-gray-500 text-3xl"></i>
            </div>
        @endif
        
        <h4 class="font-bold text-gray-900 text-xl mb-1">{{ $agent->name }}</h4>
        <p class="text-gray-600 text-sm mb-4 font-medium">{{ $agent->title }}</p>
        
        @if($agent->bio)
            <p class="text-gray-600 text-sm leading-relaxed mb-6">{{ $agent->bio }}</p>
        @endif
    </div>
    
    <div style="display: flex; flex-direction: column; gap: 12px;">
        <a href="{{ $agent->phone_link }}" 
           style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 16px 24px; background-color: #1f2937; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.2s;">
            <i class="fas fa-phone" style="margin-right: 12px; color: #f472b6;"></i>
            Call Agent
        </a>
        
        <a href="{{ $agent->whatsapp_link }}" 
           target="_blank"
           style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 16px 24px; background-color: #10b981; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.2s;">
            <i class="fab fa-whatsapp" style="margin-right: 12px; color: white;"></i>
            WhatsApp Agent
        </a>
    </div>
</div>
