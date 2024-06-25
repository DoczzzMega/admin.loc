<?php
if (!empty($_POST['title']) && !empty($_POST['text'])) {
  $text = $_POST['text'];

  // $text = preg_replace('/' . '^\s*$' . '/ium', '', $_POST['text']);
  // $text = preg_replace('/\n+/', "\n", $text);

  $data = [
    'title' => $_POST['title'],
    'text' => ($text),
  ];

  // ------------ 1 вариант, через сериализацию и сохранение в текстовый файл ------------
  $data = serialize($data);
  file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/1.txt', $data . PHP_EOL, LOCK_EX | FILE_APPEND);


  // ------------ 2 вариант, через методы JSON ------------
  // if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/data/2.json') && file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data/2.json')) {
  //   $obj = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data/2.json'));
  //   $arrOfObj = [];
  //   if (is_array($obj)) {
  //     $obj[] = (object) $data;
  //     $json = json_encode($obj, JSON_UNESCAPED_UNICODE);
  //     file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/2.json', $json, LOCK_EX);
  //   } else {
  //     $arrOfObj[] = $obj;
  //     $json = json_encode($arrOfObj, JSON_UNESCAPED_UNICODE);
  //     file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/2.json', $json, LOCK_EX);
  //   }

  // } else {
  //   $json = json_encode($data, JSON_UNESCAPED_UNICODE);
  //   file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/data/2.json', $json, LOCK_EX);
  // }
  // var_dump($obj);
  // die;

  // ------------ Перезагрузка страницы (для обоих вариантов) 
  // echo $_SERVER['DOCUMENT_ROOT'] . '<br>';
  // echo __DIR__;
  header('location: /admin');
  die;
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Admin example · Bootstrap v5.0</title>

  <!-- Bootstrap core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="../stylesheet" href="css/style.css">
  <script src="../bootstrap.bundle.min.js"></script>


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
      <header class="">
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
      </header>

      <div class="p-6 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold fs-4">Admin</h1>
          <p class="col-md-8 fs-6">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
          <!-- <button class="btn btn-primary btn-sm" type="button">Learn more</button> -->
        </div>
      </div>

      <form method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        </div>

        <div class="form-group mb-4">
          <label for="exampleFormControlTextarea1">Example textarea</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="10" placeholder="Enter your text"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <footer class="pt-3 mt-4 text-muted border-top">
        &copy; BestNews 2021-2024
      </footer>
    </div>
  </main>



</body>

</html>