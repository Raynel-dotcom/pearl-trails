@extends('layouts.app')
@section('title', 'About Pearl Trails - Tourism Decision Assistant for Uganda')

@section('content')
<div class="static-page-container">
    <div class="page-hero">
        <span class="quiz-badge">Our Mission</span>
        <h1>About Pearl Trails</h1>
        <p>Connecting curious travelers with the majestic wonder, rich wildlife, and warm culture of Uganda.</p>
    </div>

    <div class="static-content-card">
        <h2>The Pearl of Africa Decision Assistant</h2>
        <p>
            Pearl Trails is an intelligent tourism platform crafted to eliminate the guesswork from planning a trip in Uganda. Whether you have 24 hours for an excursion to Jinja or two weeks to traverse the Rwenzori Mountains and Kidepo Valley, our system helps you make informed choices based on transparent budget estimations, accurate road travel times, and authentic community recommendations.
        </p>

        <h3>Our Core Commitments</h3>
        <ul class="styled-list">
            <li><strong>Fair Pricing Transparency:</strong> All displayed estimates reflect real transport costs, community accommodation rates, and official Uganda Wildlife Authority (UWA) park tariffs.</li>
            <li><strong>Support for Local Vendors:</strong> We empower homegrown Ugandan lodges, restaurants, guides, and cultural centers by connecting them directly with travelers through our verified vendor directory.</li>
            <li><strong>Preservation & Eco-Tourism:</strong> We champion responsible tourism that safeguards endangered mountain gorillas, chimpanzees, wetlands, and indigenous cultural heritage.</li>
        </ul>

        <h3>Official Partnerships & Information</h3>
        <p>
            Information across our platform is aligned with recommendations from the Uganda Tourism Board (UTB) and the Uganda Wildlife Authority (UWA). All prices are presented as planning estimates to guide domestic and international travelers.
        </p>

        <div class="static-action-box">
            <a href="{{ route('plan') }}" class="btn btn-gold">Plan Your Custom Trip Now</a>
            <a href="{{ route('list-business') }}" class="btn btn-outline">List Your Business</a>
        </div>
    </div>
</div>
@endsection
