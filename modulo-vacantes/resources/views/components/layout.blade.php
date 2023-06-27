 <html>

 <head>
     <title>UTN FRRO</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 </head>

 <body>
     <div class="navbar navbar-expand-lg navbar-light bg-primary">
         <header class="container">
             <img src="https://alumnos.frro.utn.edu.ar/utn1.gif" class="img-thumbnail" alt="logo utn" width="70px">
             <h1>UTN FRRO</h1>
             <span class="material-symbols-outlined" style="font-size: 64px;">account_circle</span>
         </header>
     </div>

     <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
         <div class="container">
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav">
                     @if(Request::get('u')==='a')
                     <li class="nav-item">
                         <a class="nav-link" href="#">Administracion de usuarios</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">Administracion de llamados</a>
                     </li>
                     @elseif(Request::get('u')==='j')
                     <li class="nav-item">
                         <a class="nav-link" href="#">Vacantes de mi catedra</a>
                     </li>
                     @else
                     <li class="nav-item">
                         <a class="nav-link" href="#">Vacantes abiertas</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#">Vacantes cerradas</a>
                     </li>
                     @endif
                 </ul>
             </div>

         </div>
     </nav>
     <main class="container wrapper bg-dark-subtle p-5">
         {{ $slot }}
     </main>

     <footer class="footer bg-secondary text-light py-4">
         <div class="container">
             <div class="row">
                 <div class="col-md-6">
                     <h4>Sobre nosotros</h4>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam blandit justo sed ullamcorper vestibulum.</p>
                 </div>
                 <div class="col-md-3">
                     <h4>Contactanos</h4>
                     <ul class="list-unstyled">
                         <li><i class="fa fa-map-marker"></i> Zeballos 1345, Rosario, Santa Fe</li>
                         <li><i class="fa fa-envelope"></i> utn@vacantes.com</li>
                         <li><i class="fa fa-phone"></i> +3354 722384</li>
                     </ul>
                 </div>
             </div>
             <hr>
             <div class="text-center">
                 <p>&copy; 2023 Universidad Tecnologica Nacional. Todos los derechos reservados.</p>
             </div>
         </div>
     </footer>

 </body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

 </html>
