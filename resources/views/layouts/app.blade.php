<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

    <style>
    footer {
      background-color: #f2f2f2; /* Light gray background */
      padding: 30px 0; /* Top and bottom padding */
      color: #333; /* Text color */
    }

    .footer-icons a {
      color: inherit; /* Inherit text color from footer */
      font-size: 10px; /* Adjust font size for icons */
      margin: 0 10px;
    }

    .footer-icons a:hover {
      color: #007bff; /* Blue on hover */
    }
  </style>
</head>

<body>
    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- FOOTER -->
    <footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Tentang Kami</h3>
                <p>Resto.go reservasi resto jadi mudah dan cepat dimana saja</p>
                <p>Jln. Pagar Alam Raya, No.30</p>
                <p>072-65245</p>
                <p>restogo@gmail.com</p>
            </div>
            <div class="col-md-4">
                <h3>Layanan</h3>
                <ul>
                    <li><p>Reservasi</p></li>
                    <li><p>Ulasan</p></li>
                </ul>

                <p>&copy<span id="tahun"></span> Resto.go  All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script>
          var now = new Date();
          var tahun = now.getFullYear();
          document.getElementById("tahun").innerHTML = tahun;
        </script>
</body>
</html>
