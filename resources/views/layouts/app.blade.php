 <!DOCTYPE html>
 <html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICE LOGISTIQUE</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script src="{{ asset('js/script.js') }}"></script> -->

</head>

<body>
    <div class="header">
        <img src="{{ asset('img/logo.png') }}" style="float:left;width:100px;height:100px;" />
        <div>
            <h1>DIRECTION REGIONALE CASABLANCA-SETTAT</h1>
            <h3>SERVICE LOGISTIQUE</h3>
        </div>
    </div>
    <div class="clearfix">
        <div class="column menu">
            <ul>
                <li class="groupe"><i class="fas fa-chart-line"></i> ETATS</li>
                <li class="space"><i class="fas fa-search"></i><a href="{{ route('commandes.index') }}"> Rechercher</a></li>
                <li class="space"><i class="fas fa-clipboard-list"></i><a href="{{ route('commandesList.index') }}"> Suivi des Commandes</a></li>
                <li class="space"><i class="fas fa-list-alt"></i><a href="{{ route('rubriques.index') }}"> Suivi des rubriques</a></li>
                <li class="space"><i class="fas fa-money-bill-wave"></i><a href="{{ route('raps.index') }}"> Suivi des RAP</a></li>
                
                <li class="groupe"><i class="fas fa-shopping-cart"></i> COMMANDES</li>
                <li class="space"><i class="fas fa-plus-circle"></i><a href="{{ route('commandes.create') }}"> Créer une commande</a></li>
                <li class="space"><i class="fas fa-file-alt"></i><a href="{{ route('boncommandes.create') }}"> Créer un bon commande</a></li>
                <li class="space"><i class="fas fa-edit"></i><a href="{{ route('commandesUpdate.index') }}"> Mettre à jour une commande</a></li>
                
                <li class="groupe"><i class="fas fa-undo"></i> RETOURS</li>
                <li class="space"><i class="fas fa-undo"></i><a href="{{ route('commandes.retours') }}"> Retours d'une commande</a></li>
                
                <li class="groupe"><i class="fas fa-list-alt"></i> RUBRIQUES</li>
                <li class="space"><i class="fas fa-plus"></i><a href="{{ route('rubriques.create') }}"> Créer une rubrique</a></li>
                <li class="space"><i class="fas fa-edit"></i><a href="{{ route('rubriquesUpdate.index') }}"> Modifier une rubrique</a></li>
    
                
                <li class="groupe"><i class="fas fa-list-alt"></i> add</li>
                <li class="space"><i class="fas fa-plus"></i><a href="{{ route('fournisseurs.index') }}"> list des fournisseur</a></li>
                <li class="space"><i class="fas fa-edit"></i><a href="{{ route('responsables.index') }}">list des responsable</a></li>
                <li class="space"><i class="fas fa-edit"></i><a href="{{ route('complexes.index') }}">list des complexes</a></li>
    
            </ul>
        </div>
        <div class="column content">
            <button id="menu-toggle" class="menu-toggle-button" onclick="toggleMenu()"><i class="fa-solid fa-arrow-left"></i></button>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>


</body>

</html>

