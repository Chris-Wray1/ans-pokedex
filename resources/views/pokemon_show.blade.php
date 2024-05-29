<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pokemon App</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/app.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="/js/app.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="card pokemon-card">
            <div class="card-body">
                <?php 
                    $t = [];
                    if($pokemon['default']) {$t[] = 'Default';}
                    if($pokemon['mega']) {$t[] = 'Mega';}
                ?>
                <div class="card-text pokemon-id"><?= $pokemon['id'] ?></div>
                <div class="card-text pokemon-types"><?= implode(' and ', $t) ?></div>
                <hr>
                <h5 class="card-title pokemon-title"><?= ucwords($pokemon['name']) ?></h5>
                <div class="card-grid"> 
                    <?php foreach($pokemon['images'] AS $alt => $url){ 
                        if (!empty($url)) {?>
                            <div class="card-grid-child" style='background-image: url("<?= $url ?>")'>&nbsp;</div>
                        <?php } 
                    } ?>
                </div>
            </div>
            <div class="card-body pokemon-card-body" style="margin-top: 5vh;">
                <hr>
                <div class="card-text pokemon-category">Abilities</div>
                <?php foreach($pokemon['abilities'] as $ability => $desc) { ?>
                    <div class="card-text pokemon-sub-category"><?= ucwords($ability) ?></div>
                    <div class="card-text pokemon-description"><?= ucwords($desc) ?></div>
                <?php } ?> 
            </div>

            <div class="card-body pokemon-card-body">
                <hr>
                <div class="card-text pokemon-category">Attack types</div>
                <?php foreach($pokemon['types'] as $type) { ?>
                    <div class="card-text pokemon-sub-category" style="text-align: center;"><?= ucwords($type) ?></div>
                <?php } ?> 
            </div>

            <div class="card-body pokemon-card-body">
                <hr>
                <a href="\" class="btn btn-primary">Return to Pokemon list</a>
            </div>

        </div>

    </body>
</html>
