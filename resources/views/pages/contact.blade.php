@extends('layouts.app')

@section('title', 'Contact Us - Pearl Trails Uganda')
@section('meta_description', 'Get in touch with Pearl Trails for trip planning help, business listing enquiries, or partnership opportunities in Uganda tourism.')

@section('content')
<div class="contact-page-wrapper">
    <div class="page-hero contact-hero">
        <span class="quiz-badge">Get in Touch</span>
        <h1>Contact Pearl Trails</h1>
        <p>Have questions about planning your Uganda itinerary or listing your tourism enterprise? We reply within 2 working days.</p>
    </div>

    @if(session('contact_success'))
        <div class="contact-success-banner" role="alert">
            <span class="success-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </span>
            <div style="flex: 1;">
                <strong>Message sent successfully!</strong>
                <p>Thank you for reaching out. We reply within 2 working days.</p>
                @if(!empty(config('site.whatsapp')))
                    @php
                        $msgExcerpt = session('submitted_message') ? ': ' . Str::limit(session('submitted_message'), 80) : '';
                        $waPrompt = urlencode("Hello Pearl Trails, I just submitted an inquiry" . $msgExcerpt);
                    @endphp
                    <div style="margin-top: 0.65rem;">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('site.whatsapp')) }}?text={{ $waPrompt }}" 
                           target="_blank" 
                           rel="noopener" 
                           class="btn-vendor-outline" 
                           style="background: #25D366; color: #ffffff; border-color: #25D366; font-size: 0.8rem; padding: 0.35rem 0.9rem; text-decoration: none;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 4px;">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            Continue directly on WhatsApp &rarr;
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="contact-layout-grid">
        <!-- LEFT COLUMN: Contact Details & List Business CTA -->
        <div class="contact-left-col">
            <!-- Details Card -->
            <div class="contact-details-card">
                <h2 class="contact-card-title">Headquarters & Enquiries</h2>
                <p class="contact-card-intro">Reach out to our team directly for custom safari itineraries, verified recommendations, and support.</p>

                <div class="contact-details-list">
                    @if(!empty(config('site.address')))
                        <div class="contact-detail-item">
                            <span class="detail-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </span>
                            <div class="detail-content">
                                <span class="detail-label">Location</span>
                                <span class="detail-value">{{ config('site.address') }}</span>
                            </div>
                        </div>
                    @endif

                    @if(!empty(config('site.email')))
                        <div class="contact-detail-item">
                            <span class="detail-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                            <div class="detail-content">
                                <span class="detail-label">Email</span>
                                <a href="mailto:{{ config('site.email') }}" class="detail-link">{{ config('site.email') }}</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty(config('site.phone')))
                        <div class="contact-detail-item">
                            <span class="detail-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </span>
                            <div class="detail-content">
                                <span class="detail-label">Telephone</span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}" class="detail-link">{{ config('site.phone') }}</a>
                            </div>
                        </div>
                    @endif

                    @if(!empty(config('site.whatsapp')))
                        <div class="contact-detail-item">
                            <span class="detail-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                            </span>
                            <div class="detail-content">
                                <span class="detail-label">WhatsApp</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('site.whatsapp')) }}" target="_blank" rel="noopener" class="detail-link">
                                    Chat on WhatsApp
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(!empty(config('site.hours')))
                        <div class="contact-detail-item">
                            <span class="detail-icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                            <div class="detail-content">
                                <span class="detail-label">Hours</span>
                                <span class="detail-value">{{ config('site.hours') }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="response-pledge-note">
                    <p>We reply within 2 working days.</p>
                </div>
            </div>

            <!-- List Your Business Card (Separate card under details) -->
            <div class="contact-vendor-card">
                <span class="vendor-card-badge">Partner With Us</span>
                <h3 class="vendor-card-title">List Your Tourism Business</h3>
                <p class="vendor-card-desc">Operate a safari lodge, local eatery, or recreation centre in Uganda? Showcase your property to domestic and international travellers.</p>
                <a href="{{ route('list-your-business') }}" class="btn-vendor-outline">
                    List Your Business &rarr;
                </a>
            </div>
        </div>

        <!-- RIGHT COLUMN: Message Form Card -->
        <div class="contact-right-col">
            <div class="contact-form-card">
                <h2 class="contact-card-title">Send Us a Message</h2>
                <p class="contact-card-intro">Fill out the form below and our team will get in touch regarding your travel enquiry.</p>

                <form action="{{ route('contact.send') }}" method="POST" class="contact-form" novalidate>
                    @csrf

                    <div class="contact-field-group">
                        <label for="contactName" class="contact-label">Your Name <span class="req">*</span></label>
                        <input type="text" 
                               id="contactName" 
                               name="name" 
                               class="contact-input @error('name') is-invalid @enderror" 
                               required 
                               placeholder="e.g. Sarah Namubiru" 
                               value="{{ old('name') }}"
                               aria-describedby="@error('name') name-error @enderror">
                        @error('name')
                            <span class="field-error-msg" id="name-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-field-group">
                        <label for="contactEmail" class="contact-label">Email Address <span class="req">*</span></label>
                        <input type="email" 
                               id="contactEmail" 
                               name="email" 
                               class="contact-input @error('email') is-invalid @enderror" 
                               required 
                               placeholder="you@example.com" 
                               value="{{ old('email') }}"
                               aria-describedby="@error('email') email-error @enderror">
                        @error('email')
                            <span class="field-error-msg" id="email-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-field-group">
                        <label for="contactSubject" class="contact-label">Subject <span class="req">*</span></label>
                        <input type="text" 
                               id="contactSubject" 
                               name="subject" 
                               class="contact-input @error('subject') is-invalid @enderror" 
                               required 
                               placeholder="e.g. Gorilla trekking itinerary inquiry" 
                               value="{{ old('subject') }}"
                               aria-describedby="@error('subject') subject-error @enderror">
                        @error('subject')
                            <span class="field-error-msg" id="subject-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-field-group">
                        <label for="contactMessage" class="contact-label">Your Message <span class="req">*</span></label>
                        <textarea id="contactMessage" 
                                  name="message" 
                                  rows="6" 
                                  class="contact-textarea @error('message') is-invalid @enderror" 
                                  required 
                                  placeholder="How can we assist your Uganda travel experience?"
                                  aria-describedby="@error('message') message-error @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="field-error-msg" id="message-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="contact-submit-row">
                        <button type="submit" class="btn-contact-submit">
                            Send Message &rarr;
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
