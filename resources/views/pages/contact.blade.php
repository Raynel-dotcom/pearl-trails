@extends('layouts.app')
@section('title', 'Contact Us — Inquiries & Support - Pearl Trails Uganda')
@section('meta_description', 'Get in touch with Pearl Trails for trip planning help, lodge booking inquiries, or partnership opportunities in Uganda tourism.')

@section('content')
<div class="contact-page-wrapper topo-pattern" style="padding: 4rem 0 6rem;">
    <div class="container">
        <!-- Editorial Header -->
        <div class="page-hero-editorial" style="margin-bottom: 3.5rem;">
            <span class="glass-badge glass-badge-gold" style="margin-bottom: 1rem;">Get In Touch</span>
            <h1 class="page-hero-title">Contact Pearl Trails</h1>
            <p class="page-hero-subtitle">
                Have questions about coordinating your Uganda itinerary, park permits, or listing your tourism enterprise? Our team in Kampala is here to assist you.
            </p>
        </div>

        @if(session('contact_success'))
            <div style="background: rgba(32, 92, 73, 0.12); border: 1.5px solid var(--color-safari); border-radius: var(--radius-md); padding: 1.25rem 1.75rem; color: var(--color-forest); margin-bottom: 3rem; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow-sm);">
                <span style="font-size: 1.5rem; font-weight: 800; color: var(--color-gold);">✓</span>
                <div>
                    <strong style="font-size: 1.05rem; display: block; margin-bottom: 0.2rem;">Message Sent Successfully!</strong>
                    <span style="font-size: 0.92rem; color: var(--text-muted);">Thank you for reaching out. The Pearl Trails team will review your inquiry and respond promptly.</span>
                </div>
            </div>
        @endif

        <div class="contact-grid">
            <!-- Left Info Card -->
            <div class="contact-info-card">
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase; letter-spacing: 1.5px;">Headquarters</span>
                <h3 style="font-size: 1.75rem; color: var(--text-heading); margin: 0.5rem 0 1.5rem;">Kampala Support Desk</h3>
                
                <div style="display: flex; flex-direction: column; gap: 1.25rem; font-size: 0.95rem; margin-bottom: 2rem;">
                    <div>
                        <strong style="display: block; color: var(--text-heading);">Location:</strong>
                        <span style="color: var(--text-muted);">Kampala, Uganda (East Africa)</span>
                    </div>
                    <div>
                        <strong style="display: block; color: var(--text-heading);">Direct Email:</strong>
                        <a href="mailto:pearltrailsug@gmail.com" style="color: var(--color-forest); font-weight: 700; text-decoration: underline;">pearltrailsug@gmail.com</a>
                    </div>
                    <div>
                        <strong style="display: block; color: var(--text-heading);">Operating Hours:</strong>
                        <span style="color: var(--text-muted);">Monday – Saturday: 8:00 AM – 6:00 PM EAT</span>
                    </div>
                    <div>
                        <strong style="display: block; color: var(--text-heading);">Online Response:</strong>
                        <span style="color: var(--text-muted);">Inquiries submitted below typically receive a reply within 2 to 4 business hours.</span>
                    </div>
                </div>

                <div style="background: var(--bg-body); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 1.5rem; margin-top: auto;">
                    <h4 style="font-size: 1.1rem; color: var(--text-heading); margin-bottom: 0.5rem;">Are you a lodge owner or tour operator?</h4>
                    <p style="font-size: 0.88rem; color: var(--text-muted); margin-bottom: 1.25rem; line-height: 1.5;">
                        Register your property to get featured directly on our Where to Stay, Where to Eat, and Recreation directories.
                    </p>
                    <a href="{{ route('list-your-business') }}" class="btn btn-sm btn-gold">List Your Business</a>
                </div>
            </div>

            <!-- Right Message Form Card -->
            <div class="contact-form-card">
                <span style="font-size: 0.78rem; font-weight: 700; color: var(--color-gold); text-transform: uppercase; letter-spacing: 1.5px;">Direct Message</span>
                <h3 style="font-size: 1.75rem; color: var(--text-heading); margin: 0.5rem 0 1.5rem;">Send Us an Inquiry</h3>

                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="contactName">Your Name</label>
                        <input type="text" id="contactName" name="name" required placeholder="e.g. Sarah Namubiru" value="{{ old('name') }}">
                        @error('name') <span style="color: #ef4444; font-size: 0.82rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="contactEmail">Email Address</label>
                        <input type="email" id="contactEmail" name="email" required placeholder="you@example.com" value="{{ old('email') }}">
                        @error('email') <span style="color: #ef4444; font-size: 0.82rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="contactSubject">Subject</label>
                        <input type="text" id="contactSubject" name="subject" required placeholder="e.g. Bwindi gorilla permits & custom itinerary inquiry" value="{{ old('subject') }}">
                        @error('subject') <span style="color: #ef4444; font-size: 0.82rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="contactMessage">Your Message</label>
                        <textarea id="contactMessage" name="message" rows="5" required placeholder="How can our team assist your Uganda travel plans?">{{ old('message') }}</textarea>
                        @error('message') <span style="color: #ef4444; font-size: 0.82rem; margin-top: 0.25rem; display: block;">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
