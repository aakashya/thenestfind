<!DOCTYPE html>
<html lang="en">

<head>
  @include('includes.head')
  <!-- Include head section -->
</head>

<body>
  @include('includes.header')
  <!-- Include header -->

  <main>
    @yield('content')
    <!-- This is where page-specific content will go -->
  </main>

  @include('includes.our-partners')

  @include('includes.contactus')

  @include('includes.footer')
  <!-- Include footer -->

  @yield('scripts')
</body>

</html>