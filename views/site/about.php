<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
</head>
<body>
    <style>
        .container.clashh {
    width: 13%!important;
    padding-bottom: 0%!important;
}
    </style>
    <div class="container" style="text-align: center;margin-top: 20px;">
            <h1>Listado de Productos</h1>

    </div>
    <div class="container pre-scrollable" style="max-height: 500px!important;">
        <div class="row">
            
            <?php foreach($model as $d){ ?>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="box card">
                    <div class="box cardImg">
                        <img src="../<?php $i=0; foreach($d->fotosProductos as $foto){ if($i==0){ echo $foto->ruta; $i++;}} ?>" alt="...">
                    </div>
                    <div class="info">
                        <p><?php echo $d->nombreProducto; ?></p>
                     
                    </div>
                </div>
            </div>
            
           <?php }?>
            
            
           
           

        </div>
    </div>

</body>
</html>
<style>
    .box
{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 8px 0 rgba(0, 0, 0, 0.19);
    border-radius: 10px;
}
.card
{
    margin-top: 80px;
    height: 300px;
    transition: 0.5s;
}
.card:hover
{
    border: 1px solid red;
    border-radius: 30px;
}
.card .cardImg
{
    height: 150px;
    width: 90%;
    position: relative;
        padding: 0px!important;

    top: -15px;
    left: 5%;
}
.card .cardImg img
{
    width: 100%;
    height: 100%;
}

.card .info
{
    text-align: center;
}
.card .info h3
{
    color: rgb(70, 66, 66);
}
.card .info p
{
    color: black;
}

.ligne
{
    display: flex;
}

</style>