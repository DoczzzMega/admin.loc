<?php

ini_set('xdebug.var_display_max_data', '4000');

// ------------ 0 вариант, через десериализации тектового файла ------------

$fd = fopen($_SERVER['DOCUMENT_ROOT'] . '/data/1.txt', 'rb');
$str = fread($fd, filesize($_SERVER['DOCUMENT_ROOT'] . '/data/1.txt'));
// $listOfDataTxt = preg_split('/[\}' . preg_quote(PHP_EOL, '/') . ']+$/ium', $str, -1, PREG_SPLIT_NO_EMPTY);
preg_match_all('/a:\d+:\{.*?\}/s', $str, $matches);
$listOfDataTxt = $matches[0];
$news = [];
foreach($listOfDataTxt as $data) {
  // $data = preg_replace('/' . preg_quote(PHP_EOL, '/') . '$/ium', '<br>', $data);  // ------------ ??? КАК ЗАМЕНИТЬ ПЕРЕНОСЫ СТРОК НА ТЕГИ <br> ???
  // $data = str_replace(PHP_EOL, '<br>', $data);                                    // ------------
  
  $news[] = unserialize($data);
}
// $listOfDataTxt = explode(PHP_EOL, $str);
foreach($news as $new) {
  var_dump($new['text']);
  // $new['text'] = str_replace(PHP_EOL, '<br>', $new['text']);
}

var_dump($listOfDataTxt);
var_dump($news);


// ------------ 1 вариант, через десериализации тектового файла (не актуально)------------
// $listOfDataTxt = file($_SERVER['DOCUMENT_ROOT'] . '/data/1.txt');
// $news = [];
// foreach ($listOfDataTxt as $data) {
//   // $data = preg_replace('/' . preg_quote(PHP_EOL, '/') . '$/ium', '', $data);
//   $data = rtrim($data, PHP_EOL);

//   var_dump($data);
//   $news[] = unserialize($data);
// }
// var_dump($news);
// die;

// ------------ 2 вариант, через методы JSON ------------
$json = file_get_contents('./data/2.json');
$listOfData = json_decode($json);
foreach($listOfData as $new) {
  $new->text = preg_replace('/' . preg_quote(PHP_EOL, '/') . '/iu', '<br>', $new->text);
}

$json = null;  //  Нужно закомментировать эту строку для включения рендера 2 варианта, через методы JSON

// var_dump($listOfData);
// die;

?>

 <!-- ------------ Html со скриптами php для обоих вариантов (рендер) -->

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Render example · Bootstrap v5.0</title>

  <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/"> -->



  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="/bootstrap.bundle.min.js"></script>
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


</head>

<body>

  <main>
    <div class="container py-4">
      <!-- <header class="">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">Fixed navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                  <ul class="dropdown-menu" aria-labelledby="dropdown03">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
              </ul>
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
          </div>
        </nav>
      </header> -->

      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Hello world</h1>
          <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
          <button class="btn btn-primary btn-lg" type="button">Learn more</button>
        </div>
      </div>

      <div class="row align-items-md-stretch">
       
        <?php
        if (isset($json)) {
          foreach ($listOfData as $new) { ?>
            <div class="col-md-4 mb-4">
              <div class="h-100 p-5 bg-light border rounded-3">
                <h2><?= $new->title ?></h2>
                <p><?= $new->text ?></p>
                <button class="btn btn-outline-secondary" type="button">sdsdnkn</button>
                <a class="btn btn-outline-secondary" href="/?act=news">Vew details</a>
              </div>
            </div>
          <?php }
        } else {
          foreach ($news as $new) { ?>
            <div class="col-md-4 mb-4">
              <div class="h-100 p-5 bg-light border rounded-3">
                <h2><?= $new['title'] ?></h2>
                <p><?= $new['text'] ?></p>
                <button class="btn btn-outline-secondary" type="button">Vew details</button>
              </div>
            </div>
        <?php }
        }
        ?>


        <footer class="pt-3 mt-4 text-muted border-top">
          &copy; BestNews 2021-2024
        </footer>
      </div>
  </main>



</body>

</html>