<nav id="main-nav" class="bg-white shadow-sm transition-all duration-300 z-50">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-accent rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">G</span>
                    </div>
                    <span class="text-xl font-bold text-primary search-property-heading">Govener Realty</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <div class="relative group">
                    <a href="#about" class="text-secondary hover:text-primary transition-colors duration-200 flex items-center">
                        About Us
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
                <div class="relative group">
                    <a href="#services" class="text-secondary hover:text-primary transition-colors duration-200 flex items-center">
                        Services
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
                <div class="relative group">
                    <a href="{{ route('properties.index') }}" class="text-secondary hover:text-primary transition-colors duration-200">
                        Properties
                    </a>
                </div>
                <div class="relative group">
                    <a href="{{ route('blog.index') }}" class="text-secondary hover:text-primary transition-colors duration-200">
                        Blog
                    </a>
                </div>
                <div class="relative group">
                    <a href="#resources" class="text-secondary hover:text-primary transition-colors duration-200 flex items-center">
                        Resources
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
                <div class="relative group">
                    <a href="{{ route('contact') }}" class="text-secondary hover:text-primary transition-colors duration-200">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Contact Info & CTA -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="tel:1300782492" class="text-primary hover:text-accent transition-colors duration-200 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    1300 782 492
                </a>
                <a href="{{ route('contact') }}" class="search-property-button flex items-center">
                    Contact Us
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-primary hover:text-accent focus:outline-none focus:text-accent" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-menu hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-primary font-medium">Home</a>
                <a href="#about" class="block px-3 py-2 text-secondary hover:text-primary transition-colors duration-200">About</a>
                <a href="#services" class="block px-3 py-2 text-secondary hover:text-primary transition-colors duration-200">Services</a>
                <a href="{{ route('properties.index') }}" class="block px-3 py-2 text-secondary hover:text-primary transition-colors duration-200">Properties</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-secondary hover:text-primary transition-colors duration-200">Blog</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-secondary hover:text-primary transition-colors duration-200">Contact</a>
                <div class="pt-4">
                    <a href="tel:+1234567890" class="block px-3 py-2 text-primary font-medium">
                        📞 (123) 456-7890
                    </a>
                    <a href="{{ route('contact') }}" class="block mx-3 mt-2 btn-primary text-center">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mainNav = document.getElementById('main-nav');
    
    // Scroll-triggered sticky header
    let lastScrollTop = 0;
    let scrollThreshold = 100; // Start sticking after 100px scroll

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > scrollThreshold) {
            // Add sticky classes when scrolled past threshold
            mainNav.classList.add('fixed', 'top-0', 'left-0', 'right-0');
            mainNav.classList.add('shadow-lg');
        } else {
            // Remove sticky classes when at top
            mainNav.classList.remove('fixed', 'top-0', 'left-0', 'right-0');
            mainNav.classList.remove('shadow-lg');
        }
        
        lastScrollTop = scrollTop;
    });
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>
