@extends('layouts.accommodation-layout')

@section('title', $accommodation->name)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/accommodation.css') }}" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/mediaqueries-accommodation.css') }}" />
@endpush


@section('scripts')
<script src="{{ asset('js/accomodation.js') }}"></script>
@endsection

@section('content')

<section id="property-page">
  <div class="grid-container">
    <!-- Left Section -->
    <div class="left-section">
      <div class="property-main-container">
        <div class="hero-carousel">
          <div class="grid-images">
            @if(is_array($accommodation->property_photos) && count($accommodation->property_photos) > 0)
            @foreach ($accommodation->property_photos as $index => $photo)
            <div class="item {{ $index === 0 ? 'left visible' : 'hidden' }}">
              <img src="{{ $photo['link'] }}" alt="Accommodation Image">
            </div>
            @endforeach
            @else
            <p>No images available</p>
            @endif
          </div>
          <!-- Navigation Buttons -->
          <div class="carousel-nav">
            <button class="left-arrow">
              < </button>
                <button class="right-arrow"> > </button>
          </div>
          <!-- Image counter -->
          <div class="image-counter">1/8</div>
        </div>

        <div class="property-overview">
          <div class="property-head">
            <div class="property-head-name">
              <h1>{{ $accommodation->name }}, {{ $accommodation->city }}</h1>
              <p>{{ $accommodation->address }}, {{ $accommodation->city }}, {{ $accommodation->state }}</p>
            </div>
            <div class="pricing">
              <p class="price-around">From</p>
              @php
                // Define country-to-currency mapping
                $currencySymbols = [
                    'United Kingdom' => '£', // UK
                    'USA' => '$', // USA
                    'United States' => '$', // Alternative name for the USA
                    'Canada' => '$', // Canada
                    'Australia' => 'A$', // Australia
                    'Europe' => '€', // Europe
                    'India' => '₹', // India
                ];

                // Get the currency symbol based on the country (default to £)
                $currencySymbol = $currencySymbols[$accommodation->country] ?? '£';

                // Get the lowest price from all rooms
                $lowestPrice = $accommodation->rooms->map(function($room) {
                    $prices = json_decode($room->prices, true);
                    return $prices['base_price'] ?? null;
                })->filter()->min();
            @endphp
            <p class="price">{{ $currencySymbol }}{{ number_format($lowestPrice, 0) }}</p>
              <p class="price-around">per week</p>
            </div>
          </div>
        </div>
      </div>

      <!-- About the Property -->
      <div class="property-about-container">
        <div class="property-about-head">
          <h3>About the Property</h3>
        </div>
        <div class="property-about-body">
          <p class="description">{{ $accommodation->description }}</p>
          <!-- <button class="read-more-btn">Show More</button> -->
        </div>
      </div>

      <!-- Rooms Section -->
      <div id="room-options" class="property-room-container">
        <div class="property-room-head">
          <h3>Room Options</h3>
        </div>
        @foreach($rooms as $room)
        @php
        $prices = json_decode($room->prices, true); // Decode JSON price data
        $basePrice = $prices['base_price'] ?? 'N/A'; // Extract base price
        $formattedPrice = $currencySymbol . number_format($basePrice); // Format price correctly
        $availableFrom = \Carbon\Carbon::parse($room->available_at)->format('F j, Y'); // Format date
        @endphp
        <div class="property-room-items {{ 'room' . $loop->index }}" data-images="{{ json_encode($room->photos) }}">
          <div class="property-room-upper">
            <div class="room-photos">
              @foreach ($room->photos as $photo)
              <div class="photo-item">
                <img src="{{ $photo['link'] }}" alt="Room Image">
              </div>
              @endforeach

              <!-- Navigation Buttons -->
              <div class="photo-nav">
                <button class="room-left-arrow">
                  < </button>
                    <button class="room-right-arrow"> > </button>
              </div>

              <!-- Image Counter -->
              <div class="room-image-counter">1/4</div>
            </div>

            <!-- Room Details Section -->
            <div class="room-details">
              <div class="rooom-details-upper">
                <h3>{{ $room->name }}</h3> <!-- Room Name from DB -->
                <p>From <span class="room-price">{{ $formattedPrice }}</span>/week</p> <!-- Base Price -->
                <p>Rooms are approximately {{ $room->room_size }} SQM.</p> <!-- Room Size -->
              </div>
              <div class="room-details-lower">
                <div class="room-detail-item">Double Bed</div>
                <div class="room-detail-item">Fully Furnished</div>
                <div class="room-detail-item">Private Kitchen</div>
                <div class="room-detail-item">Private Bathroom</div>
              </div>
            </div>
          </div>

          <div class="room-length">
            <!-- Header Row -->
            <div class="room-length-header">
              <div class="room-length-duration">
                <div class="duration-time">
                  <p><strong>Period</strong></p>
                </div>
              </div>
              <div class="room-length-price">
                <p><strong>Price</strong></p>
              </div>
            </div>

            <!-- First Room Length Item -->
            <div class="room-length-item">
              <div class="room-length-duration">
                <div class="duration-time">
                  <p>Available from {{ $availableFrom }}</p> <!-- Available Date -->
                </div>
              </div>
              <div class="room-length-price">
                <div class="price-value">
                  <p>{{ $formattedPrice }}/week</p> <!-- Base Price Again -->
                </div>
                <button class="book-now-btn">Book Now</button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

    </div>

    <!-- Right Section -->
    <div class="right-section">
      <div class="right-upper">
        <div class="property-name">
          <h3>{{ $accommodation->name }}, {{ $accommodation->city }}</h3>
        </div>
        <div class="property-cta">
          <button class="view-rooms-btn" onclick="location.href='#room-options'">View Rooms</button>
          <button id="enquire-now-btn" class="visit-site-btn">Enquire Now</button>
        </div>
      </div>

      <!-- Accordion Section -->
      <div class="RightSection-module__subSection">
        <div class="accordion-item">
          <div class="USPSection-module__accordionHeader" data-target="accordion1">
            <div class="USPSection-module__accordianItemTitle">
              <div class="USPSection-module__iconWrapper">
                {!! config('icons.priceMatch') !!}
              </div>
              Price Match Guarantee
            </div>
            <div class="chevron">
              {!! config('icons.chevron') !!}
            </div>
          </div>
          <div class="accordion-content" id="accordion1">
            If you receive a lower price offer for your preferred accommodation from any other student accommodation.
            <br><br>
            Nest Find will match that competing price at the time you book with us.
          </div>
        </div>

        <div class="accordion-item">
          <div class="USPSection-module__accordionHeader" data-target="accordion2">
            <div class="USPSection-module__accordianItemTitle">
              <div class="USPSection-module__iconWrapper">
                {!! config('icons.verifiedProperties') !!}
              </div>
              Verified Properties
            </div>
            <div class="chevron">
              {!! config('icons.chevron') !!}
            </div>
          </div>
          <div class="accordion-content" id="accordion2">
            We guarantee that what you see on our website is exactly what you'll get.
          </div>
        </div>

        <div class="accordion-item">
          <div class="USPSection-module__accordionHeader" data-target="accordion3">
            <div class="USPSection-module__accordianItemTitle">
              <div class="USPSection-module__iconWrapper">
                {!! config('icons.assistance') !!}
              </div>
              24x7 Personal Assistance
            </div>
            <div class="chevron">
              {!! config('icons.chevron') !!}
            </div>
          </div>
          <div class="accordion-content" id="accordion3">
            For any doubts or queries, a quick call is all it takes - we're here to assist you promptly.
          </div>
        </div>

        <div class="accordion-item">
          <div class="USPSection-module__accordionHeader" data-target="accordion4">
            <div class="USPSection-module__accordianItemTitle">
              <div class="USPSection-module__iconWrapper">
                {!! config('icons.trustpilot') !!}
              </div>
              Trustpilot 4.6/5
            </div>
            <div class="chevron">
              {!! config('icons.chevron') !!}
            </div>
          </div>
          <div class="accordion-content" id="accordion4">
            We've earned an excellent rating from over 20+ students for our outstanding services.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection