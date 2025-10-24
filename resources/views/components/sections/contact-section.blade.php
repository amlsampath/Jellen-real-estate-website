@props([])

<!-- Contact Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent bg-opacity-5 rounded-full -translate-y-48 translate-x-48"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary bg-opacity-5 rounded-full translate-y-40 -translate-x-40"></div>
    
    <div class="container-custom relative z-10">
        <!-- Enhanced Section Header -->
        <div class="text-center mb-20">
            <div class="inline-block mb-8">
                <span class="inline-flex items-center px-8 py-4 bg-accent text-white font-semibold rounded-lg hover:bg-accent-dark transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    📞 Get In Touch
                </span>
            </div>
            <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-8 leading-tight">
                Ready to Start Your
                <span class="block bg-gradient-to-r from-accent to-accent-dark bg-clip-text text-transparent">
                    Property Journey?
                </span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 mx-auto leading-relaxed mb-8 max-w-4xl">
                Let's discuss your property investment goals and find the perfect opportunities for you. Our expert team is here to guide you every step of the way.
            </p>
            
            <!-- Quick Contact Stats -->
            <div class="flex flex-wrap justify-center gap-8 mb-12">
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-accent rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Free Consultation</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-primary rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Expert Guidance</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-accent rounded-full"></div>
                    <span class="text-gray-700 font-semibold">24/7 Support</span>
                </div>
                <div class="flex items-center space-x-3 bg-white rounded-full px-6 py-3 shadow-lg">
                    <div class="w-3 h-3 bg-primary rounded-full"></div>
                    <span class="text-gray-700 font-semibold">Market Insights</span>
                </div>
            </div>
        </div>

        <!-- Contact Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10">
                <div class="mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Send us a message</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Fill out the form below and we'll get back to you within 24 hours with personalized property investment advice.
                    </p>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-800 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors duration-200 @error('name') border-red-500 @enderror"
                                   placeholder="Your full name"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors duration-200 @error('email') border-red-500 @enderror"
                                   placeholder="your@email.com"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors duration-200 @error('phone') border-red-500 @enderror"
                               placeholder="(123) 456-7890">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="property_interest" class="block text-sm font-semibold text-gray-700 mb-2">Property Interest</label>
                        <select id="property_interest" 
                                name="property_interest"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors duration-200 @error('property_interest') border-red-500 @enderror">
                            <option value="">Select your interest</option>
                            <option value="First-time buyer" {{ old('property_interest') == 'First-time buyer' ? 'selected' : '' }}>First-time buyer</option>
                            <option value="Investment property" {{ old('property_interest') == 'Investment property' ? 'selected' : '' }}>Investment property</option>
                            <option value="Upgrade/downgrade" {{ old('property_interest') == 'Upgrade/downgrade' ? 'selected' : '' }}>Upgrade/downgrade</option>
                            <option value="Commercial property" {{ old('property_interest') == 'Commercial property' ? 'selected' : '' }}>Commercial property</option>
                            <option value="Property management" {{ old('property_interest') == 'Property management' ? 'selected' : '' }}>Property management</option>
                            <option value="Market consultation" {{ old('property_interest') == 'Market consultation' ? 'selected' : '' }}>Market consultation</option>
                        </select>
                        @error('property_interest')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message *</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent focus:border-accent transition-colors duration-200 @error('message') border-red-500 @enderror"
                                  placeholder="Tell us about your property goals, budget, preferred locations, or any specific requirements..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-accent text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-accent-dark transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center">
                        Send Message
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Office Information -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Visit Our Office</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Main Office</h4>
                                <p class="text-gray-600">123 Collins Street<br>Melbourne VIC 3000<br>Australia</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Phone</h4>
                                <p class="text-gray-600">1300 782 492</p>
                                <p class="text-sm text-gray-500">Mon-Fri 9AM-6PM</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                <p class="text-gray-600">info@searchproperty.com.au</p>
                                <p class="text-sm text-gray-500">We respond within 24 hours</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Business Hours</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Monday - Friday</span>
                            <span class="text-gray-600">9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="font-medium text-gray-700">Saturday</span>
                            <span class="text-gray-600">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="font-medium text-gray-700">Sunday</span>
                            <span class="text-gray-600">By Appointment</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact CTA -->
                <div class="bg-gradient-to-r from-accent to-accent-dark rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-4">Need Immediate Assistance?</h3>
                    <p class="text-accent-100 mb-6">Call us now for urgent property inquiries or emergency support.</p>
                    <a href="tel:1300782492" 
                       class="inline-flex items-center bg-white text-accent px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call 1300 782 492
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
