<?php
include_once('../constants.php');
$gApi = new googleTranslate();

//$languages = $gApi->getLanguages();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Itranslate</title>
    <style>
        .content{
            display: flex;
            flex-direction: column;
            gap: 1em;
            padding: 10px;
        }

        form{
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(300px,1fr));
            grid-gap: 1em;
            padding: 5px;
        }

        input[type="submit"]{
            max-width: 300px;
            margin: 0 auto;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Itranslate</h3>
        <div class="content">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur incidunt enim necessitatibus velit, sed ullam sunt! Voluptatem numquam quasi fugiat?</p>
            <form action="" method="post">
                <div class="Bx">
                    <h4>Source language</h4>
                    <select name="sourceL" class="form-select">
                        <option value="">choose language</option>
                        <option value="auto">detect automatically</option>
                        <?php if ($languages) : ?>
                            <?php foreach ($languages as $language) : ?>
                                <option value="<?= $language['code'] ?>"><?= $language['name'] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <textarea name="sourceTexte" id="" cols="30" rows="10" class="form-control"><?= $sourceTexte ?? "Hello world" ?></textarea>
                </div>

                <div class="Bx">
                    <h4>Target language</h4>
                    <select name="targetL" class="form-select">
                        <option value="">choose language</option>
                        <?php if ($languages) : ?>
                            <?php foreach ($languages as $language) : ?>
                                <option value="<?= $language['code'] ?>"><?= $language['name'] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                    <textarea name="targetTexte" id="" cols="30" rows="10" class="form-control"><?= $targetTexte ?? "" ?></textarea>
                </div>
            </form>
            <input type="submit" value="Translate" name="submit" class="btn btn-primary">
        </div>
    </div>
</body>

</html>