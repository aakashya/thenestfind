@extends('layouts.home-layout')
<!-- This tells Laravel to use the home page layout -->

@section('title', 'Nest Find')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/mediaqueries-home.css') }}?v={{ time() }}">
@endpush

@section('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endsection

@section('content')
<section id="first">
  <div class="section__pic-container">
    <img src="/assets/home_back.jpg" alt="background pic" />
  </div>
  <div class="section-text-overlay">
    <div class="section-text-conatiner">
      <div class="section-text-items">
        <h1 class="title">
          Find Your Nest<span style="color: blue;">.</span>
          Live Your Best<span style="color: blue;">.</span>
        </h1>
        <h2>
          Find comfortable and affordable student homes in
          prime locations, designed for hassle-free living.
        </h2>
        <div class="search-wrapper">
          <div id="search-component">
            <div class="search-input-wrapper">
              <input type="text" class="search-input" placeholder="Search for 'Accommodations'" />
              <button class="search-button">
                Search
              </button>
            </div>
            <div class="search-results">
              <!-- Search item: Aldgate Residence -->
              <div class="search-item">
                <a href="/accommodations/Aldgate-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Aldgate Residence
                    </div>
                    <div class="location-address">
                      1-2 Education Square,
                      London, E1 1FA
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Brighton Residence -->
              <div class="search-item">
                <a href="/accommodations/Brighton-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Brighton Residence
                    </div>
                    <div class="location-address">
                      7 The Furlong, Lewes Road,
                      Brighton, BN2 4FR
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Dublin Residence -->
              <!-- <div class="search-item">
          <a href="/accommodations/">
          <div class="location-details">
            <div class="location-name">Dublin Residence</div>
            <div class="location-address">6-14 Stephens Street Upper, Dublin D08 CH2H</div>
          </div>
          </a>
        </div> -->

              <!-- Search item: Citi Edge Place Residence -->
              <div class="search-item">
                <a href="/accommodations/City-Edge-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      Citi Edge
                    </div>
                    <div class="location-address">
                      30 Ardwick Green South, Manchester, M13 9XE
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Drapery Place Residence -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Drapery-Place">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Drapery Place
                    </div>
                    <div class="location-address">
                      Central London,London,UK
                    </div>
                  </div>
                </a>
              </div>





              <!-- Search item: GoBritanya Ealing Residence -->
              <div class="search-item">
                <a href="/accommodations/Ealing-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Ealing Residence
                    </div>
                    <div class="location-address">
                      3 Victoria Rd, North Acton,
                      London, W3 6UN
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Edinburgh Residence -->
              <div class="search-item">
                <a href="/accommodations/Edinburgh-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      Edinburgh Residence
                    </div>
                    <div class="location-address">
                      348 West Granton Road Edinburgh, EH5 1QE
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Finsbury House Residence -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Finsbury-House.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Finsbury House
                    </div>
                    <div class="location-address">
                      North London, London, UK
                    </div>
                  </div>
                </a>
              </div>



              <!-- Search item: GoBritanya Hammersmith Residence -->
              <div class="search-item">
                <a href="/accommodations/Hammersmith-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Hammersmith Residence
                    </div>
                    <div class="location-address">
                      230 Shepherds Bush Road,
                      Hammersmith, London W6 7NL
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Highbury Residence -->
              <div class="search-item">
                <a href="/accommodations/Highbury-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Highbury Residence
                    </div>
                    <div class="location-address">
                      309 Holloway Road, London,
                      N7 9DS
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Highbury Residence II -->
              <div class="search-item">
                <a href="/accommodations/Highbury-Residence-II.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Highbury Residence II
                    </div>
                    <div class="location-address">
                      295 Holloway Road, London,
                      N7 8HS
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Hawley Crescent -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Hawley-Crescent.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Hawley Crescent
                    </div>
                    <div class="location-address">
                      London, United Kingdom
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Islington Residence -->
              <div class="search-item">
                <a href="/accommodations/Islington-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Islington Residence
                    </div>
                    <div class="location-address">
                      32-34 Market Rd, London, N7
                      9AW
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya IQ Aldgate Residence -->
              <div class="search-item">
                <a href="/accommodations/IQ-Aldgate-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya IQ Aldgate Residence
                    </div>
                    <div class="location-address">
                      66 Commercial Road, London,
                      E1 1LP
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist IQ Paris Gardens Residence -->
              <div class="search-item">
                <a href="/accommodations/Londonist-IQ-Paris-Gardens.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist IQ Paris Gardens
                    </div>
                    <div class="location-address">
                      South London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya King's Cross Residence -->
              <div class="search-item">
                <a href="/accommodations/King's-Cross-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya King's Cross Residence
                    </div>
                    <div class="location-address">
                      200 Pentonville Rd, London,
                      N1 9JP
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Kirby Street Residence -->
              <div class="search-item">
                <a href="/accommodations/Kirby-Street-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Kirby Street Residence
                    </div>
                    <div class="location-address">
                      36-43 Kirby St, Holborn,
                      EC1N 8TE
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Lewisham Residence -->
              <div class="search-item">
                <a href="/accommodations/Lewisham-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Lewisham Residence
                    </div>
                    <div class="location-address">
                      46 Thurston Rd, London, SE13
                      7SD
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Landale House  -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Landale-House.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Landale House
                    </div>
                    <div class="location-address">
                      South London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Lewisham Exchange  -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Lewisham-Exchange.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Lewisham Exchange
                    </div>
                    <div class="location-address">
                      South London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya McMillan Residence -->
              <div class="search-item">
                <a href="/accommodations/McMillan-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya McMillan Residence
                    </div>
                    <div class="location-address">
                      Creek Rd, London, SE8 3BU
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Metchley Hall Residence -->
              <div class="search-item">
                <a href="/accommodations/Metchley-Hall-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      Metchley Hall Residence
                    </div>
                    <div class="location-address">
                      500 Harborne Park Rd Harborne Birmingham, B17 0DA
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Moss Court Residence -->
              <div class="search-item">
                <a href="/accommodations/Moss-Court-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      Moss Court Residence
                    </div>
                    <div class="location-address">
                      Moss Court Manchester 422 Moss Lane East
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist New Cross Residence -->
              <div class="search-item">
                <a href="/accommodations/Londonist-New-Cross.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist New Cross
                    </div>
                    <div class="location-address">
                      East London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Old Street Residence -->
              <div class="search-item">
                <a href="/accommodations/Old-Street-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Old Street Residence
                    </div>
                    <div class="location-address">
                      18 Paul St, London, EC2A 4JH
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Oxley Residence -->
              <div class="search-item">
                <a href="/accommodations/Oxley-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      Oxley Residence
                    </div>
                    <div class="location-address">
                      Weetwood Ln, Weetwood, Leeds LS16 8HL
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item:GoBritanya Paddington Citi View -->
              <div class="search-item">
                <a href="/accommodations/Paddington-Citi-View.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Paddington Citi View
                    </div>
                    <div class="location-address">
                      15 - 25 Talbot Square,
                      London, W2 1TT
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Paris Gardens -->
              <div class="search-item">
                <a href="/accommodations/Paris-Gardens.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Paris Gardens
                    </div>
                    <div class="location-address">
                      6 Paris Garden, London, SE1
                      8ND
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Point Campus Dublin -->
              <div class="search-item">
                <a href="/accommodations/Point-Campus-Dublin.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Point Campus Dublin
                    </div>
                    <div class="location-address">
                      Mayor Street Upper, Point
                      Village Dublin D01 W2R1
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Paddington Citi View  -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Paddington-Citi-View.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Paddington Citi View
                    </div>
                    <div class="location-address">
                      London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Shoreditch Residence -->
              <div class="search-item">
                <a href="/accommodations/Shoreditch-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Shoreditch Residence
                    </div>
                    <div class="location-address">
                      2 Silicon Way, London, N1
                      6AT
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya South Bank Residence -->
              <div class="search-item">
                <a href="/accommodations/South-Bank-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya South Bank Residence
                    </div>
                    <div class="location-address">
                      17 Great Suffolk Street,
                      London, SE1 0NS
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Spitalfields Residence -->
              <div class="search-item">
                <a href="/accommodations/Spitalfields-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Spitalfields Residence
                    </div>
                    <div class="location-address">
                      9 Frying Pan Alley,
                      Spitalfields, E1 7HS
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Sterling Court (Wembley) -->
              <div class="search-item">
                <a href="/accommodations/Sterling-Court.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Sterling Court (Wembley)
                    </div>
                    <div class="location-address">
                      6 Lakeside Way, London, HA9
                      0BU
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist Seven Sisters -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Seven-Sisters.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist Seven Sisters
                    </div>
                    <div class="location-address">
                      North London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist South Bermondsey  -->
              <div class="search-item">
                <a href="/accommodations/Londonist-South-Bermondsey.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist South Bermondsey
                    </div>
                    <div class="location-address">
                      South London, London, UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: Londonist The Therese House -->
              <div class="search-item">
                <a href="/accommodations/Londonist-Therese-House.html">
                  <div class="location-details">
                    <div class="location-name">
                      Londonist The Therese House
                    </div>
                    <div class="location-address">
                      Central London, London , UK
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Vega Residence -->
              <div class="search-item">
                <a href="/accommodations/Vega-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Vega Residence
                    </div>
                    <div class="location-address">
                      iQ Vega 6 Miles St, SW8 1RZ
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Westminster Residence -->
              <div class="search-item">
                <a href="/accommodations/Westminster-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Westminster Residence
                    </div>
                    <div class="location-address">
                      200A Lambeth Road, Lambeth,
                      London SE1 7LR
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya White City Residence -->
              <div class="search-item">
                <a href="/accommodations/White-City-Residence.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya White City Residence
                    </div>
                    <div class="location-address">
                      10 Westway, East Acton,
                      London, W12 0DD
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya Your TRIBE Peckham -->
              <div class="search-item">
                <a href="/accommodations/Your-TRIBE-Peckham.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Your TRIBE Peckham
                    </div>
                    <div class="location-address">
                      28 YourTRIBE Peckham,
                      Ruby Street
                    </div>
                  </div>
                </a>
              </div>
              <!-- Search item: GoBritanya YourTribe South Bermondsey -->
              <div class="search-item">
                <a href="/accommodations/Your-TRIBE-South-Bermondsey.html">
                  <div class="location-details">
                    <div class="location-name">
                      GoBritanya Your TRIBE South Bermondsey
                    </div>
                    <div class="location-address">
                      Bermondsey, Ilderton Road,
                      SE15 1NW
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="second">
  <div class="second-container">
    <div class="second-details-container">
      <div class="second-inner-containers">
        <div class="icons-items">
          <h3>25K+</h3>
          <p>Beds</p>
        </div>
        <div class="icons-items">
          <h3>1k+</h3>
          <p>Properties</p>
        </div>
        <div class="icons-items">
          <h3>40+</h3>
          <p>Students Assisted</p>
        </div>
        <div class="icons-items">
          <h3>18+</h3>
          <p>Cities</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Static Country Selection -->
{{-- <div id="countries-container">
  <div class="country-head" data-country-id="1">
    <div class="country-img">
      <img src="{{ asset('assets/Icons/Countries/Britain-2-128.png') }}" alt="United Kingdom" />
    </div>
    <div class="country-name">United Kingdom</div>
  </div>
  <div class="country-head" data-country-id="2">
    <div class="country-img">
      <img src="{{ asset('assets/Icons/Countries/Ireland-2-128.png') }}" alt="Ireland" />
    </div>
    <div class="country-name">Ireland</div>
  </div>
  <div class="country-head" data-country-id="3">
    <div class="country-img">
      <img src="{{ asset('assets/Icons/Countries/USA_-4-128.png') }}" alt="United States" />
    </div>
    <div class="country-name">United States</div>
  </div>
  <div class="country-head" data-country-id="4">
    <div class="country-img">
      <img src="{{ asset('assets/Icons/Countries/australia-2-128.png') }}" alt="Australia" />
    </div>
    <div class="country-name">Australia</div>
  </div>
</div> --}}

<section id="locations">
  <div class="locations-container">
    <div class="cities-head">
      <h1>Begin Your Journey. Find Your Nest.</h1>
    </div>

    <div id="countries-container">
      <div class="country-head" data-country="UK">
        <div class="country-img">
          <img src="/assets/Icons/Countries/Britain-2-128.png" alt="UK" />
        </div>
        <div class="country-name">United Kingdom</div>
      </div>
      <div class="country-head" data-country="Ireland">
        <div class="country-img">
          <img src="/assets/Icons/Countries/Ireland-2-128.png" alt="Ireland" />
        </div>
        <div class="country-name">Ireland</div>
      </div>
      <div class="country-head" data-country="US">
        <div class="country-img">
          <img src="/assets/Icons/Countries/USA_-4-128.png" alt="US" />
        </div>
        <div class="country-name">United States</div>
      </div>
      <div class="country-head" data-country="Australia">
        <div class="country-img">
          <img src="/assets/Icons/Countries/australia-2-128.png" alt="Australia" />
        </div>
        <div class="country-name">Australia</div>
      </div>
    </div>

    <div class="cities-container">
      <div class="city" data-country="UK">
        <a href="{{ url('/city/london') }}"><img src="assets/Cities/London.webp" alt="London" />
          <span class="city-name">London</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/birmingham') }}"><img src="assets/Cities/Birmingham.webp" alt="Birmingham" />
          <span class="city-name">Birmingham</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/manchester') }}"><img src="assets/Cities/Manchester.webp" alt="Manchester" />
          <span class="city-name">Manchester</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/leeds') }}"><img src="assets/Cities/leeds.webp" alt="Leeds" />
          <span class="city-name">Leeds</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/brighton') }}"><img src="assets/Cities/Brighton.webp" alt="Brighton" />
          <span class="city-name">Brighton</span></a>
      </div>
      <div class="city" data-country="Ireland">
        <a href="{{ url('/city/dublin') }}"><img src="assets/Cities/Dublin.webp" alt="Dublin" />
          <span class="city-name">Dublin</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/edinburgh') }}"><img src="assets/Cities/Edinburgh.webp" alt="Edinburgh" />
          <span class="city-name">Edinburgh</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="{{ url('/city/sheffield') }}"><img src="assets/Cities/Sheffield.webp" alt="Sheffield" />
          <span class="city-name">Sheffield</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Belfast.webp" alt="Belfast" />
          <span class="city-name">Belfast</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Bristol.webp" alt="Bristol" />
          <span class="city-name">Bristol</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Cardiff.webp" alt="Cardiff" />
          <span class="city-name">Cardiff</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Coventry.webp" alt="Coventry" />
          <span class="city-name">Coventry</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Exeter.webp" alt="Exeter" />
          <span class="city-name">Exeter</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Glasgow.webp" alt="Glasgow" />
          <span class="city-name">Glasgow</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Liverpool.webp" alt="Liverpool" />
          <span class="city-name">Liverpool</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/new-castle.webp" alt="New Castle" />
          <span class="city-name">New Castle</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/Nottingham.webp" alt="Nottingham" />
          <span class="city-name">Nottingham</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/southampton.webp" alt="Southampton" />
          <span class="city-name">Southampton</span></a>
      </div>
      <div class="city" data-country="UK">
        <a href="#" onClick="return false;"><img src="assets/Cities/York.webp" alt="York" />
          <span class="city-name">York</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'new-york-city') }}"><img src="assets/Cities/new-york.webp" alt="New York" />
          <span class="city-name">New York</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'boston') }}"><img src="assets/Cities/Boston.webp" alt="Boston" />
          <span class="city-name">Boston</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'washington-dc') }}"><img src="assets/Cities/washington-dc.webp" alt="Washington DC" />
          <span class="city-name">Washington DC</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'chicago') }}"><img src="assets/Cities/chicago.webp" alt="Chicago" />
          <span class="city-name">Chicago</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'austin') }}"><img src="assets/Cities/Austin.webp" alt="Austin" />
          <span class="city-name">Austin</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'los-angeles') }}"><img src="assets/Cities/los-angeles.webp" alt="Los Angeles" />
          <span class="city-name">Los Angeles</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'san-francisco') }}"><img src="assets/Cities/san-francisco.webp" alt="San Francisco" />
          <span class="city-name">San Francisco</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'san-diego') }}"><img src="assets/Cities/san-diego.webp" alt="San Diego" />
          <span class="city-name">San Diego</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'dallas') }}"><img src="assets/Cities/Dallas.webp" alt="Dallas" />
          <span class="city-name">Dallas</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="{{ route('city.show', 'jersey-city') }}"><img src="assets/Cities/jersey-city.webp" alt="Jersey City" />
          <span class="city-name">Jersey City</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="#" onClick="return false;"><img src="assets/Cities/Houston.webp" alt="Houston" />
          <span class="city-name">Houston</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="#" onClick="return false;"><img src="assets/Cities/philadelphia.webp" alt="Philadephia" />
          <span class="city-name">Philadephia</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="#" onClick="return false;"><img src="assets/Cities/Miami.webp" alt="Miami" />
          <span class="city-name">Miami</span></a>
      </div>
      <div class="city" data-country="US">
        <a href="#" onClick="return false;"><img src="assets/Cities/minneapolis.webp" alt="Minneapolis" />
          <span class="city-name">Minneapolis</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Sydney.webp" alt="Sydney" />
          <span class="city-name">Sydney</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Melbourne.webp" alt="Melbourne" />
          <span class="city-name">Melbourne</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Brisbane.webp" alt="Brisbane" />
          <span class="city-name">Brisbane</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Canberra.webp" alt="Canberra" />
          <span class="city-name">Canberra</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Perth.webp" alt="Perth" />
          <span class="city-name">Perth</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/gold-coast.webp" alt="Gold Coast" />
          <span class="city-name">Gold Coast</span></a>
      </div>
      <div class="city" data-country="Australia">
        <a href="#" onClick="return false;"><img src="assets/Cities/Adelaide.webp" alt="Adelaide" />
          <span class="city-name">Adelaide</span></a>
      </div>
    </div>
  </div>
</section>
@endsection