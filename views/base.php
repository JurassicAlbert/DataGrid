<?php 
session_start();

if (! isset($_SESSION["tableHead"]))
{
    header("Location: /datagrid");
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="https://use.fontawesome.com/09a1cdb215.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header class="bg-dark text-light h-100 my-3 border rounded">
            <div class="mx-auto text-center py-5">
                <h1 class="text-uppercase">Data-Grid</h1>
                <h4 class="">Biblioteka do łatwego formatowania i renderowania tabel z danymi.</h4>
            </div>
        </header>
        <section class="border border-dotted rounded p-2 d-flex-column justify-content-center">
        <?php 
            if (isset($_SESSION['error'])) 
            {
                print('<div class="p-2 m-2 alert alert-danger" role="alert">'.$_SESSION["error"].'</div>');
                unset($_SESSION['error']);
            } 
        ?>
            <form action="/datagrid/" method="GET">
                <table id="renderTable" class='table table-lg table-bordered p-0 m-0'>
                    <thead>
                        <tr>
                            <?=  $_SESSION["tableHead"]; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $_SESSION["tableBody"] ?>
                    </tbody>
                </table>
                <div class="d-flex-column align-items-center text-center justify-content-center">
                    <nav aria-label="..." class="d-flex justify-content-center pt-2">
                        <ul class="pagination d-flex p-0 m-0 flex-wrap">
                            <?= $_SESSION["tablePagination"] ?>
                        </ul>
                    </nav>
                    <div class="pt-2 d-flex-inline align-items-center justify-content-center">
                        <div><label for="rows">Il. wierszy: </label><?= $_SESSION['rows'] ?></div>
                        <div><button type="submit" class="btn btn-link">Renderuj</button></div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>