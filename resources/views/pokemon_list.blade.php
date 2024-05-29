<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pokemon App</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="css/app.css" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="js/app.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <?php
            $error_display = (!empty($error))? 'block' : 'none'; 
        ?>

        <div class="alert alert-danger" style="display: <?= $error_display ?>;">
            <strong><?= $error ?></strong>
        </div>

        <div class="container mt-5">
            <div style="display: inline-block; float: right; text-align: left;">
                <br>
                <span><strong>Number of Pokemon : </strong><?= $count ?></span>
            </div>
        </div>
        <div class="container mt-5">
            <h3>Available Pokemon</h3><br>
            <input class="form-control inline-search" type="text" id="pokemonSearch" onkeyup="tableSearch('pokemonSearch', 'pokemon')" placeholder="Search for pokemon..">
            <br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">PokeAPI ID</th>
                        <th scope="col">Pokemon Name</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="pokemon">
                    <?php foreach ($pokemon_list as $pokemon) { ?>
                        <tr>
                            <td><?=$pokemon['pokeapi_id']?></td>
                            <td><?=$pokemon['name']?></td>
                            <td><a class='btn btn-warning' href="/view/<?=$pokemon['pokeapi_id']?>">View</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </body>
</html>
