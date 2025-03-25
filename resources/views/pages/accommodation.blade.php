@extends('layouts.accommodation-layout')

@section('title', $accommodation->provider . ' ' . $accommodation->zip . ': ' . $accommodation->name . ', ' . $accommodation->city)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/accommodation.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/mediaqueries-accommodation.css') }}?v={{ time() }}">
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
              <  
            </button>
            <button class="right-arrow">
              >
            </button>
          </div>
          <!-- Image counter -->
          <div class="image-counter">1/8</div>
        </div>

        <div class="property-overview">
          <div class="property-head">
            <div class="property-head-name">
              <h1>{{ $accommodation->provider }} {{ $accommodation->zip }}: {{ $accommodation->name }}, {{ $accommodation->city }}</h1>
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
              $lowestPrice = $accommodation->rooms->whereNotNull('price')->min('price');
              @endphp
              <p class="price">{{ $currencySymbol }}{{ number_format($lowestPrice, 0) }}</p>
              <p class="price-around">per month</p>
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
        </div>
      </div>

      <!-- Rooms Section -->
      <div id="room-options" class="property-room-container">
        <div class="property-room-head">
          <h3>Room Options</h3>
        </div>
        @foreach($rooms as $room)
        @php
        $basePrice = $room->price ?? 'N/A'; // Use the new price column
        $formattedPrice = $currencySymbol . number_format($basePrice); // Format price correctly
        $availableFrom = $room->available_at ? \Carbon\Carbon::parse($room->available_at)->format('F j, Y') : 'N/A'; // Format date
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
                    <button class="room-right-arrow">></button>
              </div>

              <!-- Image Counter -->
              <div class="room-image-counter">1/4</div>
            </div>

            <!-- Room Details Section -->
            <div class="room-details">
              <div class="rooom-details-upper">
                <h3>{{ $room->name }}</h3> <!-- Room Name from DB -->
                <p>From <span class="room-price">{{ $formattedPrice }}</span>/month</p> <!-- Base Price -->
                <p>Rooms are approximately {{ $room->room_size }} SQM.</p> <!-- Room Size -->
              </div>
              <div class="room-details-lower">
                <div class="room-detail-item">
                  {{ $room->room_type === 'private' ? 'Private Room' : 'Shared Room' }}
                </div>
                <div class="room-detail-item">
                  {{ $room->fully_furnished ? 'Fully Furnished' : 'Unfurnished' }}
                </div>
                <div class="room-detail-item">
                  {{ $room->private_kitchen ? 'Private Kitchen' : 'Shared Kitchen' }}
                </div>
                <div class="room-detail-item">
                  {{ $room->private_bathroom ? 'Private Bathroom' : 'Shared Bathroom' }}
                </div>
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
            <div class="room-length-item" data-room-id="{{ $room->id }}">
              <div class="room-length-duration">
                <div class="duration-time">
                  <p>Available from {{ $availableFrom }}</p> <!-- Available Date -->
                </div>
              </div>
              <div class="room-length-price">
                <div class="price-value">
                  <p>{{ $formattedPrice }}/month</p> <!-- Base Price Again -->
                </div>
                <button type="button" class="book-now-btn">Book Now</button>
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
    </div>
  </div>
</section>
@endsection