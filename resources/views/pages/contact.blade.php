@section('title', 'Contact Us - Pearl Trails Uganda')
@section('meta_description', 'Get in touch with Pearl Trails for trip planning help, business listing enquiries, or partnership opportunities in Uganda tourism.')

@section('content')
<div class="static-page-container">
    <div class="page-hero">
        <span class="quiz-badge">Get in Touch</span>
        <h1>Contact Pearl Trails</h1>
        <p>Have questions about planning your Uganda itinerary or listing your tourism enterprise? We are here to help.</p>
    </div>

    @if(session('contact_success'))
        <div class="budget-fit-banner within-budget" style="margin-bottom: 2rem;">
            <span class="fit-icon">✓</span>
            <div>
                <strong>Message sent successfully!</strong>
                <span>Thank you for reaching out. The Pearl Trails team will review your message and respond shortly.</span>
            </div>
        </div>
    @endif

    <div class="contact-grid">
        <div class="contact-info-card">
            <h3>Headquarters & Support</h3>
            <p><strong>Location:</strong> Kampala, Uganda (East Africa)</p>
            <p><strong>Email:</strong> <a href="mailto:pearltrailsug@gmail.com">pearltrailsug@gmail.com</a></p>
            <p><strong>Support:</strong> Monday – Saturday: 8:00 AM – 6:00 PM EAT</p>
            <p><strong>Online Assistance:</strong> Submit your enquiry using the message form and our team will get back to you promptly.</p>
            
            <div class="contact-badge-box">
                <h4>Are you a tour operator or accommodation owner?</h4>
                <p>Register your property to get featured on our Stays, Eat, and Recreation pages.</p>
                <a href="{{ route('list-your-business') }}" class="btn btn-sm btn-primary">List Your Business</a>
            </div>
        </div>

        <div class="contact-form-card">
            <h3>Send Us a Message</h3>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="contactName">Your Name</label>
                    <input type="text" id="contactName" name="name" required placeholder="e.g. Sarah Namubiru" value="{{ old('name') }}">
                    @error('name') <span class="text-danger" style="color: #ef4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="contactEmail">Email Address</label>
                    <input type="email" id="contactEmail" name="email" required placeholder="you@example.com" value="{{ old('email') }}">
                    @error('email') <span class="text-danger" style="color: #ef4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="contactSubject">Subject</label>
                    <input type="text" id="contactSubject" name="subject" required placeholder="e.g. Gorilla trekking itinerary inquiry" value="{{ old('subject') }}">
                    @error('subject') <span class="text-danger" style="color: #ef4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="contactMessage">Your Message</label>
                    <textarea id="contactMessage" name="message" rows="5" required placeholder="How can we assist your Uganda journey?">{{ old('message') }}</textarea>
                    @error('message') <span class="text-danger" style="color: #ef4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
