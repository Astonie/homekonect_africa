@extends('layouts.public')

@section('title', 'About Us - Home Konnect')

@section('content')
<section class="relative min-h-[50vh] flex items-center bg-cover bg-center bg-no-repeat"
    style="background-image: url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?q=80&w=2096');">
    <!-- Subtle overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/50 to-black/40"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center text-background">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                About <span class="text-primary">Home Konnect</span>
            </h1>

            <p class="text-xl text-background/90 leading-relaxed max-w-3xl mx-auto mb-8">
                We're revolutionizing the way people find and connect with their dream homes.
                Discover our story and what makes us different.
            </p>

            
        </div>
    </div>
</section>

<section id="mission" class="pt-20 pb-16 bg-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-text-primary mb-6">About Home Konnect</h1>
            <p class="text-xl text-text-secondary max-w-3xl mx-auto leading-relaxed">
                We're revolutionizing the way people find and connect with their dream homes.
                Our platform combines cutting-edge technology with personalized service to make
                property hunting seamless and enjoyable.
            </p>
        </div>

        <!-- Mission & Vision -->
        <div class="grid md:grid-cols-2 gap-12 mb-20">
            <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-4">Our Mission</h3>
                <p class="text-text-secondary leading-relaxed">
                    To empower everyone to find their perfect home by providing a transparent,
                    efficient, and trustworthy real estate platform that connects property seekers
                    with verified listings and expert guidance.
                </p>
            </div>

            <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-4">Our Vision</h3>
                <p class="text-text-secondary leading-relaxed">
                    To become the most trusted and innovative real estate platform globally,
                    where technology meets humanity to create meaningful connections between
                    people and their future homes.
                </p>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-primary rounded-2xl p-12 mb-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-background mb-2">10,000+</div>
                    <div class="text-primary-100">Properties Listed</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-background mb-2">5,000+</div>
                    <div class="text-primary-100">Happy Customers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-background mb-2">500+</div>
                    <div class="text-primary-100">Expert Agents</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-background mb-2">50+</div>
                    <div class="text-primary-100">Cities Covered</div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-text-primary mb-6">Why Choose Home Konnect?</h2>
            <p class="text-xl text-text-secondary max-w-3xl mx-auto">
                We combine technology, trust, and personalized service to deliver exceptional results.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="text-center group">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8 mx-auto group-hover:bg-primary/20 transition-colors duration-300">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-4">Verified Properties</h3>
                <p class="text-text-secondary leading-relaxed">
                    Every property listing undergoes rigorous verification to ensure authenticity,
                    accuracy, and compliance with local regulations.
                </p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8 mx-auto group-hover:bg-primary/20 transition-colors duration-300">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-4">Secure Transactions</h3>
                <p class="text-text-secondary leading-relaxed">
                    Bank-level security protects all your transactions and personal information.
                    Your data is encrypted and never shared without permission.
                </p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mb-8 mx-auto group-hover:bg-primary/20 transition-colors duration-300">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-text-primary mb-4">24/7 Support</h3>
                <p class="text-text-secondary leading-relaxed">
                    Our dedicated support team is available around the clock to assist you
                    with any questions or concerns you may have.
                </p>
            </div>
        </div>

        <!-- Team Section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-text-primary mb-6">Meet Our Leadership Team</h2>
            <p class="text-xl text-text-secondary max-w-3xl mx-auto">
                Passionate professionals dedicated to transforming the real estate industry.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-background rounded-xl p-6 shadow-lg border border-border text-center">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary">JD</span>
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-2">John Doe</h3>
                <p class="text-primary font-medium mb-3">CEO & Founder</p>
                <p class="text-text-secondary text-sm">
                    With over 15 years in real estate, John leads our vision of making property
                    hunting accessible to everyone.
                </p>
            </div>

            <div class="bg-background rounded-xl p-6 shadow-lg border border-border text-center">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary">JS</span>
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-2">Jane Smith</h3>
                <p class="text-primary font-medium mb-3">CTO</p>
                <p class="text-text-secondary text-sm">
                    Technology innovator focused on building cutting-edge solutions that
                    revolutionize the real estate experience.
                </p>
            </div>

            <div class="bg-background rounded-xl p-6 shadow-lg border border-border text-center">
                <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-bold text-primary">MJ</span>
                </div>
                <h3 class="text-xl font-bold text-text-primary mb-2">Mike Johnson</h3>
                <p class="text-primary font-medium mb-3">Head of Operations</p>
                <p class="text-text-secondary text-sm">
                    Ensures seamless operations and maintains the highest standards of
                    service across all our platforms.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-background mb-4">Ready to Start Your Journey?</h2>
        <p class="text-lg text-primary-100 mb-8">
            Join thousands of satisfied customers who found their dream homes with us.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/" class="inline-flex items-center px-6 py-3 bg-background text-primary font-semibold rounded-lg hover:bg-background/90 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Browse Properties
            </a>
            <a href="/login" class="inline-flex items-center px-6 py-3 bg-secondary text-primary font-semibold rounded-lg hover:bg-secondary/90 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Get Started
            </a>
        </div>
    </div>
</section>
@endsection