<nav id="desktop-nav">
  <div class="nav-container">
    <a href="{{ route('home') }}" class="logo">
      <div class="logo-icon">
        <img src="/assets/Nest_find_new.png" alt="Nest Find" />
      </div>
      <div class="logo-name">NEST FIND</div>
    </a>
    <div>
      <div class="nav-links">
        <div class="nav-contact-wrapper">

          <div class="nav-contact-item big-screen-only">
            <a href="https://wa.me/447448519063" target="_blank" rel="noopener noreferrer">
              <img src="/assets/Icons/elements/whatsapp.png" alt="WhatsApp" />
            </a>
          </div>
          <div class="nav-contact-item nav-contact-circle big-screen-only" id="big-screen-contact-trigger">
            <img src="/assets/Icons/elements/telephone_icon.svg" alt="Contact" />
          </div>


          <div class="nav-contact-icons small-screen-only">
            <div class="nav-contact-item">
              <a href="https://wa.me/447448519063" target="_blank" rel="noopener noreferrer">
                <img src="/assets/Icons/elements/whatsapp.png" alt="WhatsApp" />
              </a>
            </div>
            <div class="nav-contact-item" id="small-screen-contact-trigger">
              <img src="/assets/Icons/elements/telephone_icon.svg" alt="Contact" />
            </div>
          </div>
          <div class="contact-popper" id="contact-popper" style="display: none;">
            <ul>
              <li>
                <img src="/assets/Icons/elements/phone_icon.svg" alt="Phone" width="13" height="13" class="contact-icon-inverted">
                <a href="tel:+917015197023">+91 701 519 7023</a>
              </li>
              <li>
                <img src="/assets/Icons/elements/phone_icon.svg" alt="Phone" width="13" height="13" class="contact-icon-inverted">
                <a href="tel:+447448519063">+44 744 851 9063</a>
              </li>
              <li>
                <img src="/assets/Icons/elements/mail_icon.svg" alt="Email" width="13" height="13" class="contact-icon-inverted">
                <a href="mailto:info@thenestfind.com">info@thenestfind.com</a>
              </li>
            </ul>
          </div>
        </div>

        <div class="nav-links-container nav-desktop location-container">
          <div class="dropdown nav-item">
            <a class="navitem-dropdown-padding" href="#">
              Locations
              <!-- Arrow Down SVG -->
              <svg fill="#000000" height="16px" width="16px" viewBox="0 0 330 330" xmlns="http://www.w3.org/2000/svg">
                <path d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393
          c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393
          s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z" />
              </svg>
            </a>
            <div class="dropdown-options">
              <a class="dropdownitems-link" href="{{ url('/city/london') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="UK logo" />
                <span>London</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/birmingham') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="UK logo" />
                <span>Birmingham</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/manchester') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="UK logo" />
                <span>Manchester</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/leeds') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="UK logo" />
                <span>Leeds</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/brighton') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="UK logo" />
                <span>Brighton</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/edinburgh') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_uk.svg" alt="Ireland logo" />
                <span>Edinburgh</span>
              </a>
              <a class="dropdownitems-link" href="{{ url('/city/dublin') }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_ireland.svg" alt="Ireland logo" />
                <span>Dublin</span>
              </a>
              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'new-york']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>New York</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'boston']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Boston</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'washington-dc']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Washington DC</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'chicago']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Chicago</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'austin']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Austin</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'los-angeles']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Los Angeles</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'san-francisco']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>San Francisco</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'san-diego']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>San Diego</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'dallas']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Dallas</span>
              </a>

              <a class="dropdownitems-link" href="{{ route('city.show', ['city' => 'jersey-city']) }}">
                <img src="https://publicassets.leverageedu.com/accommodation/fly_usa.svg" alt="USA logo" />
                <span>Jersey City</span>
              </a>

            </div>
          </div>
        </div>
        <div class="nav-links-container nav-desktop">
          <div class="nav-item">
            <a class="navitem-dropdown-padding" href="/static/blogs">Blogs</a>
          </div>
        </div>
        <div class="nav-links-container">
          <div class="hamburger-container">
            <div class="hamburger-option">
              <a href="javascript:void(0);" id="hamburger-trigger" class="">
                <img src="/assets/Icons/elements/hamburger.svg" alt="Hamburger Menu" />
              </a>
            </div>
            <div class="hamburger-dropdown" id="hamburger-dropdown" style="display: none;">
              <ul>
                <li>
                  <a href="{{ url('static/aboutus') }}">About Us</a>
                </li>
                <li>
                  <a href="javascript:void(0);">
                    Refer & Earn <span>£50</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>