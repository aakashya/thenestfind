@extends('layouts.location-layout')

@section('title', $city)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/locations.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/properties.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/mediaqueries-location.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('css/pagination.css') }}?v={{ time() }}">

@endpush

@section('scripts')
<script src="{{ asset('js/location.js') }}"></script>
@endsection

@section('content')

<section id="city-head-section">
  <div class="city-image-container">
    @php
        // Convert city name to lowercase and replace spaces with hyphens
        $citySlug = strtolower(str_replace(' ', '-', $city));
        $backgroundImage = asset("assets/background/{$citySlug}.webp");
    @endphp

    <img src="{{ $backgroundImage }}" alt="{{ $city }} student residences">
  </div>
  <div class="image-head-container">
    <h1 class="city-title">{{ $city }} Accommodations</h1>
  </div>
</section>

<section id="city-info-section">
  <div class="city-info-container m">
    <h2>Your Student Adventure Begins With Nest Find.</h2>
    <p>Explore modern residences featuring state-of-the-art amenities such as a Gym, Study Lounges, Rooftop
      Terraces, Cinema Rooms, Co-working Spaces, Game Rooms, and more! Experience vibrant student living in prime locations,
      designed to support your lifestyle and academic success.</p>
  </div>
</section>

<section id="city-properties">
  <div class="city-properties-container">
    <div class="city-properties-head m">
      <h1>Student Nests in {{ $city }}</h1>
      <p>Price Match Guarantee | Flexible Booking | Short & Long-Term Stays</p>
    </div>

    <div class="c1">
      @foreach($accommodations as $accommodation)
      @php
        // Determine the currency symbol based on the country
        $currencySymbol = ($accommodation->country == 'UK') ? '£' : '$';
        // Ensure lowest price is formatted correctly
        $lowestPrice = $accommodation->lowest_price ? number_format($accommodation->lowest_price, 0) : 'N/A';
      @endphp

      <div class="c2">
        <div class="c3">
          <div class="c4">
            <div class="c5">
              <div class="c6">
                @if(!empty($accommodation->cover_image))
                <img src="{{ asset($accommodation->cover_image) }}" alt="{{ $accommodation->name }}" class="c7">
                @endif
              </div>
            </div>
            <a href="{{ route('accommodation.show', ['id' => $accommodation->id]) }}" class="c12"></a>
          </div>
          <a href="{{ route('accommodation.show', ['id' => $accommodation->id]) }}" class="c13">
            <h4 class="c14">
              <span>{{ $accommodation->partner }} {{ $accommodation->name }}</span>
            </h4>
            <p class="c15">
              <svg width="14" height="14" fill="#6b7280" viewBox="0 0 12 14" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.1875 5.25C8.1875 6.45859 7.20859 7.4375 6 7.4375C4.79141 7.4375 3.8125 6.45859 3.8125 5.25C3.8125 4.04141 4.79141 3.0625 6 3.0625C7.20859 3.0625 8.1875 4.04141 8.1875 5.25ZM6 6.5625C6.72461 6.5625 7.3125 5.97461 7.3125 5.25C7.3125 4.52539 6.72461 3.9375 6 3.9375C5.27539 3.9375 4.6875 4.52539 4.6875 5.25C4.6875 5.97461 5.27539 6.5625 6 6.5625ZM11.25 5.25C11.25 7.63984 8.05078 11.8945 6.64805 13.65C6.31172 14.0684 5.68828 14.0684 5.35195 13.65C3.92461 11.8945 0.75 7.63984 0.75 5.25C0.75 2.35047 3.10047 0 6 0C8.89844 0 11.25 2.35047 11.25 5.25ZM6 0.875C3.58281 0.875 1.625 2.83281 1.625 5.25C1.625 5.67656 1.77348 6.26172 2.07781 6.98359C2.37613 7.6918 2.79531 8.46016 3.26945 9.22852C4.20078 10.7406 5.30547 12.1871 6 13.0594C6.69453 12.1871 7.79922 10.7406 8.73164 9.22852C9.20469 8.46016 9.62305 7.6918 9.92109 6.98359C10.2273 6.26172 10.375 5.67656 10.375 5.25C10.375 2.83281 8.41719 0.875 6 0.875Z"
                  fill="#6b7280"></path>
              </svg>
              {{ $accommodation->address }}, {{ $accommodation->city }}
            </p>
            <div class="c16">
              From <span class="c17">{{ $currencySymbol }}{{ $lowestPrice }}</span> / month
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="pagination">
      {{ $accommodations->links('vendor.pagination.semantic-ui') }}
    </div>
  </div>
</section>

@endsection
