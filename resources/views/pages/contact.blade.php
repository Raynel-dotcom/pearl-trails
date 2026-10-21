@extends('layouts.app')
@section('title', 'Contact Us - Pearl Trails Uganda')

@section('content')
<div class="static-page-container">
    <div class="page-hero">
        <span class="quiz-badge">Get in Touch</span>
        <h1>Contact Pearl Trails</h1>
        <p>Have questions about planning your Uganda itinerary or listing your tourism enterprise? We are here to help.</p>
    </div>

    <div class="contact-grid">
        <div class="contact-info-card">
            <h3>Headquarters & Support</h3>
            <p><strong>Location:</strong> Kampala, Uganda (East Africa)</p>
            <p><strong>Email:</strong> info@pearltrails.ug</p>
            <p><strong>Hotline:</strong> +256 700 000 000 / +256 770 000 000</p>
            <p><strong>Operating Hours:</strong> Monday - Saturday: 8:00 AM - 6:00 PM EAT</p>
            
            <div class="contact-badge-box">
                <h4>Are you a tour operator or accommodation owner?</h4>
                <p>Register your property to get featured on our Stays, Eat, and Recreation pages.</p>
                <a href="{{ route('list-business') }}" class="btn btn-sm btn-gold">List Your Business</a>
            </div>
        </div>

        <div class="contact-form-card">
            <h3>Send Us a Message</h3>
            <form onsubmit="event.preventDefault(); alert('Thank you for reaching out! A Pearl Trails representative will respond shortly.');">
                <div class="form-group">
                    <label for="contactName">Your Name</label>
                    <input type="text" id="contactName" required placeholder="e.g. Sarah Namubiru">
                </div>
                <div class="form-group">
                    <label for="contactEmail">Email Address</label>
                    <input type="email" id="contactEmail" required placeholder="you@example.com">
                </div>
                <div class="form-group">
                    <label for="contactSubject">Subject</label>
                    <input type="text" id="contactSubject" required placeholder="e.g. Gorilla trekking itinerary inquiry">
                </div>
                <div class="form-group">
                    <label for="contactMessage">Your Message</label>
                    <textarea id="contactMessage" rows="5" required placeholder="How can we assist your Uganda journey?"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
