@extends('layouts.public')

@section('title', 'Contact Us - Home Konnect')

@section('content')
<section class="relative min-h-[50vh] flex items-center bg-cover bg-center bg-no-repeat"
    style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=2073');">
    <!-- Subtle overlay for text readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/50 to-black/40"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center text-background">
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                Contact <span class="text-primary">Us</span>
            </h1>

            <p class="text-xl text-background/90 leading-relaxed max-w-3xl mx-auto mb-8">
                Have questions about our services? Need help finding your dream home?
                We're here to help every step of the way.
            </p>
        </div>
    </div>
</section>

<section id="contact-form" class="pt-20 pb-16 bg-secondary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-text-primary mb-6">Contact Us</h1>
            <p class="text-xl text-text-secondary max-w-3xl mx-auto leading-relaxed">
                Have questions about our services? Need help finding your dream home?
                We're here to help. Reach out to our team and we'll get back to you promptly.
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                <h2 class="text-2xl font-bold text-text-primary mb-6">Send us a Message</h2>

                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-text-primary mb-2">First Name</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200" placeholder="John">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-text-primary mb-2">Last Name</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200" placeholder="Doe">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-text-primary mb-2">Email Address</label>
                        <input type="email" class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200" placeholder="john@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-text-primary mb-2">Phone Number</label>
                        <input type="tel" class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200" placeholder="+1 (555) 123-4567">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-text-primary mb-2">Subject</label>
                        <select class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200">
                            <option value="">Select a subject</option>
                            <option value="general">General Inquiry</option>
                            <option value="property">Property Information</option>
                            <option value="agent">Become an Agent</option>
                            <option value="support">Technical Support</option>
                            <option value="feedback">Feedback</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-text-primary mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-3 rounded-lg border-2 border-border focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 text-text-primary bg-background transition-all duration-200 resize-none" placeholder="Tell us how we can help you..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-background py-3 px-6 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Details -->
                <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                    <h2 class="text-2xl font-bold text-text-primary mb-6">Get in Touch</h2>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-text-primary mb-1">Email Us</h3>
                                <p class="text-text-secondary">info@homekonnect.com</p>
                                <p class="text-text-secondary">support@homekonnect.com</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-text-primary mb-1">Call Us</h3>
                                <p class="text-text-secondary">+234 803 123 4567</p>
                                <p class="text-text-secondary">Mon-Fri: 9AM - 6PM EST</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-text-primary mb-1">Visit Us</h3>
                                <p class="text-text-secondary">Plot 12, Admiralty Way, Lekki Phase 1</p>
                                <p class="text-text-secondary">Lagos, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Office Hours -->
                <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                    <h3 class="text-xl font-bold text-text-primary mb-6">Office Hours</h3>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-border/50">
                            <span class="text-text-primary font-medium">Monday - Friday</span>
                            <span class="text-text-secondary">9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-border/50">
                            <span class="text-text-primary font-medium">Saturday</span>
                            <span class="text-text-secondary">10:00 AM - 4:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-text-primary font-medium">Sunday</span>
                            <span class="text-text-secondary">Closed</span>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-primary/5 rounded-lg border border-primary/20">
                        <p class="text-sm text-text-secondary">
                            <strong class="text-primary">Emergency Support:</strong> Available 24/7 for urgent property-related matters.
                        </p>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-background rounded-xl p-8 shadow-lg border border-border">
                    <h3 class="text-xl font-bold text-text-primary mb-6">Follow Us</h3>

                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors duration-300 group">
                            <svg class="w-6 h-6 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors duration-300 group">
                            <svg class="w-6 h-6 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors duration-300 group">
                            <svg class="w-6 h-6 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-primary/10 hover:bg-primary/20 rounded-lg flex items-center justify-center transition-colors duration-300 group">
                            <svg class="w-6 h-6 text-primary group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.749.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001.012.017z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection