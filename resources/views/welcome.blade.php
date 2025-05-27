@extends('layouts.app', ['showFooter' => true])

@section('title', 'DevsAI - AI-Powered Technical Specification Generator')

@push('styles')
<style>
    .gradient-text {
        background-image: linear-gradient(135deg, #6366f1, #a855f7, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        background-size: 200% auto;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-primary-900 via-primary-800 to-secondary-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Modern abstract shapes -->
            <div class="absolute w-[20rem] sm:w-[40rem] h-[20rem] sm:h-[40rem] top-0 left-0 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-br from-primary-500/30 to-secondary-500/30 rounded-full filter blur-3xl"></div>
            <div class="absolute w-[15rem] sm:w-[30rem] h-[15rem] sm:h-[30rem] bottom-0 right-0 translate-x-1/2 translate-y-1/2 bg-gradient-to-br from-secondary-500/30 to-accent-500/30 rounded-full filter blur-3xl"></div>
            <div class="absolute w-[12rem] sm:w-[25rem] h-[12rem] sm:h-[25rem] top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-gradient-to-br from-accent-400/20 to-primary-400/20 rounded-full filter blur-3xl"></div>

            <!-- Animated grid pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMSI+PHBhdGggZD0iTTM2IDM0aDR2MWgtNHYtMXptMC0yaDF2NGgtMXYtNHptMi0yaDF2MWgtMXYtMXptLTIgMmgtMXYxaDF2LTF6bS0yLTJoMXYxaC0xdi0xem0yLTJoMXYxaC0xdi0xem0tMiAydi0xaC0xdjFoMXptLTIgMmgtMXYxaDF2LTF6bS0yLTJoMXYxaC0xdi0xem0yLTJoMXYxaC0xdi0xem0tMiAydi0xaC0xdjFoMXptLTIgMmgtMXYxaDF2LTF6bS0yLTJoMXYxaC0xdi0xem0yLTJoMXYxaC0xdi0xem0tMiAydi0xaC0xdjFoMXptLTIgMmgtMXYxaDF2LTF6bS0yLTJoMXYxaC0xdi0xem0yLTJoMXYxaC0xdi0xem0tMiAydi0xaC0xdjFoMXptLTIgMmgtMXYxaDF2LTF6bS0yLTJoMXYxaC0xdi0xem0yLTJoMXYxaC0xdi0xem0tMiAydi0xaC0xdjFoMXoiLz48L2c+PC9nPjwvc3ZnPg==')]"></div>
        </div>

        <div class="container mx-auto px-4 py-16 md:py-32 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <div class="inline-flex items-center mb-4 sm:mb-6 px-3 sm:px-4 py-1.5 sm:py-2 bg-white/10 text-white text-xs sm:text-sm font-medium rounded-full backdrop-blur-md border border-white/10 shadow-soft animate-fade-in">
                    <span class="flex h-2 w-2 relative mr-1.5 sm:mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                    </span>
                    Powered by Advanced AI Technology
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-display font-bold mb-4 sm:mb-6 text-white leading-tight tracking-tight animate-slide-up">
                    Transform Ideas into <span class="gradient-text">Precision Technical Specs</span>
                </h1>

                <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-10 text-white/90 max-w-3xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 100ms">
                    DevsAI leverages state-of-the-art AI to analyze your project requirements and deliver comprehensive, professional-grade technical specifications in minutes. <span class="font-semibold">Slash preparation time, eliminate errors, and accelerate your project launches.</span>
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4 animate-slide-up" style="animation-delay: 200ms">
                    <a href="{{ route('client-response.form') }}" class="group inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-white text-primary-700 font-semibold rounded-xl hover:bg-primary-50 transform hover:-translate-y-1 transition-all duration-300 shadow-colored">
                        <span>Start Your Analysis</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1.5 sm:ml-2 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#how-it-works" class="group inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-primary-700/30 backdrop-blur-sm border border-primary-500/30 text-white font-semibold rounded-xl hover:bg-primary-700/40 transition duration-300">
                        <span>How It Works</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1.5 sm:ml-2 transition-transform duration-300 group-hover:translate-y-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="container mx-auto px-4 py-16 sm:py-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 max-w-6xl mx-auto">
            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">1,000+</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Projects Analyzed</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 100ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">99%</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Satisfaction Rate</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 200ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">10<span class="text-xl sm:text-2xl">min</span></div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Fast Analysis</div>
                </div>
            </div>

            <div class="group relative overflow-hidden p-6 sm:p-8 rounded-3xl bg-white border border-dark-100/10 shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 animate-slide-up" style="animation-delay: 300ms">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 mb-4 sm:mb-6 rounded-2xl bg-primary-100 text-primary-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl md:text-5xl font-display font-bold text-primary-600">24/7</div>
                    <div class="text-dark-600 mt-2 sm:mt-3 font-medium text-sm sm:text-base">Always Available</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="how-it-works" class="container mx-auto px-4 py-16 sm:py-24 overflow-hidden">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-20">
            <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-primary-100 text-primary-700 rounded-full text-xs sm:text-sm font-medium mb-3 sm:mb-4 animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 mr-1.5 sm:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                How It Works
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-5xl font-display font-bold mb-4 sm:mb-6 text-dark-900 animate-slide-up">From Vision to Victory in <span class="text-primary-600">3 Simple Steps</span></h2>
            <p class="text-base sm:text-lg text-dark-600 animate-slide-up" style="animation-delay: 100ms">Our intuitive AI-driven process delivers professional technical specifications, empowering you to kickstart your projects with confidence and precision.</p>
        </div>

        <div class="relative">
            <!-- Connection line -->
            <div class="absolute hidden md:block left-1/2 top-24 bottom-24 w-0.5 bg-gradient-to-b from-primary-300 via-secondary-300 to-accent-300 transform -translate-x-1/2 z-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-8 max-w-6xl mx-auto relative z-10">
                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 200ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">1</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-primary-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-base sm:text-lg">1</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 text-primary-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-primary-700 group-hover:text-primary-600 transition-colors duration-300">Define Your Vision</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Submit your project goals and requirements through our guided, user-friendly questionnaire designed to capture all essential details.</p>
                </div>

                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 300ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-secondary-100 text-secondary-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">2</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-secondary-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-secondary-100 text-secondary-600 flex items-center justify-center font-bold text-base sm:text-lg">2</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-secondary-100 text-secondary-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-secondary-700 group-hover:text-secondary-600 transition-colors duration-300">AI-Powered Analysis</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Our advanced AI processes your input, recommending optimal technologies and structuring your specifications with industry best practices.</p>
                </div>

                <div class="group relative bg-white p-6 sm:p-8 md:p-10 rounded-3xl shadow-soft hover:shadow-soft-xl transform hover:-translate-y-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 400ms">
                    <div class="absolute right-6 sm:right-8 top-6 sm:top-8 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center font-bold text-base sm:text-lg md:hidden">3</div>

                    <div class="hidden md:flex absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 sm:w-12 h-10 sm:h-12 rounded-full bg-white shadow-soft border border-accent-100 items-center justify-center z-20">
                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center font-bold text-base sm:text-lg">3</div>
                    </div>

                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center mb-4 sm:mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-8 sm:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold mb-2 sm:mb-4 text-accent-700 group-hover:text-accent-600 transition-colors duration-300">Receive Your Specs</h3>
                    <p class="text-dark-600 text-sm sm:text-base">Download a polished, professional document with tech stack, architecture, features, and accurate time and cost estimates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-24 bg-gradient-to-br from-primary-50 to-secondary-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center max-w-6xl mx-auto">
                <div class="md:w-1/2 mb-16 md:mb-0 md:pr-16">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4 animate-fade-in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Why DevsAI?
                    </div>
                    <h2 class="text-3xl md:text-5xl font-display font-bold mb-8 text-dark-900 animate-slide-up">
                        Elevate Your Projects with <span class="text-primary-600">AI-Driven Precision</span>
                    </h2>

                    <div class="space-y-6">
                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 100ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-primary-700 transition-colors duration-300">Save Weeks of Work</h3>
                                <p class="text-dark-600">Generate comprehensive specifications in minutes, not days, streamlining your project planning and accelerating development.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 200ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-secondary-100 text-secondary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-secondary-700 transition-colors duration-300">Unmatched Accuracy</h3>
                                <p class="text-dark-600">Leverage AI trained on industry best practices for reliable, up-to-date recommendations that align with current technology trends.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 300ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-accent-100 text-accent-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-accent-700 transition-colors duration-300">Realistic Budgeting</h3>
                                <p class="text-dark-600">Get precise cost and timeline estimates to plan your projects with confidence and avoid unexpected overruns.</p>
                            </div>
                        </div>

                        <div class="group flex items-start p-6 rounded-2xl bg-white/70 backdrop-blur-sm hover:bg-white hover:shadow-soft transform hover:translate-x-2 transition-all duration-300 border border-dark-100/10 animate-slide-up" style="animation-delay: 400ms">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-xl font-bold mb-2 text-dark-900 group-hover:text-primary-700 transition-colors duration-300">Professional Standards</h3>
                                <p class="text-dark-600">Receive consistent, polished documentation ready for stakeholders and developers to implement with clarity.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 relative">
                    <!-- Decorative elements -->
                    <div class="absolute -top-16 -right-16 w-64 h-64 bg-primary-300/20 rounded-full filter blur-3xl animate-float"></div>
                    <div class="absolute -bottom-16 -left-16 w-64 h-64 bg-secondary-300/20 rounded-full filter blur-3xl animate-float" style="animation-delay: 2s"></div>

                    <!-- Main image with 3D effect -->
                    <div class="relative z-10 animate-slide-up" style="animation-delay: 200ms">
                        <div class="relative group">
                            <!-- Shadow element for 3D effect -->
                            <div class="absolute -inset-1 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl blur-lg opacity-30 group-hover:opacity-50 transition duration-1000"></div>

                            <!-- Main image container -->
                            <div class="relative overflow-hidden rounded-3xl bg-white p-2 shadow-soft-xl">
                                <div class="overflow-hidden rounded-2xl">
                                    <img
                                        src="https://images.unsplash.com/photo-1581472723648-909f4851d4ae?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                                        alt="AI Analysis Dashboard"
                                        class="w-full h-auto transform transition-transform duration-700 group-hover:scale-105"
                                    >

                                    <!-- Overlay with tech elements -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/70 to-transparent flex items-end">
                                        <div class="p-6 text-white">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                                                <span class="text-sm font-medium">AI Analysis in Progress</span>
                                            </div>
                                            <h4 class="text-xl font-bold">Technical Specification Generator</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating tech elements -->
                        <div class="absolute -top-6 -right-6 bg-white rounded-2xl shadow-soft p-4 transform rotate-3 animate-float" style="animation-delay: 1s">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-soft p-4 transform -rotate-3 animate-float" style="animation-delay: 1.5s">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container mx-auto px-4 py-12 sm:py-20 text-center">
        <div class="max-w-4xl mx-auto bg-gradient-to-br from-blue-600 to-purple-700 rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl p-6 sm:p-8 md:p-12 text-white">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-6">Launch Your Next Big Idea with Precision Specs</h2>
            <p class="text-base sm:text-lg text-blue-100 mb-6 sm:mb-10 max-w-2xl mx-auto">Don’t let technical complexity slow you down. Try DevsAI today and unlock professional-grade specifications for free.</p>
            <a href="{{ route('client-response.form') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-xl hover:bg-gradient-to-r hover:from-blue-600 hover:to-purple-700 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                Get Started Now
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 ml-1.5 sm:ml-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add intersection observer for animations
    document.addEventListener('DOMContentLoaded', function() {
        const animatedElements = document.querySelectorAll('.animate-slide-up, .animate-fade-in');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
            observer.observe(el);
        });
    });
</script>
@endpush