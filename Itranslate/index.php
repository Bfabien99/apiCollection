<?php
include_once('../constants.php');
$gApi = new googleTranslate();

$languages = $gApi->getLanguages();
$error = false;

if(isset($_POST['submit'])){
    $sourceLanguage = trim(strip_tags($_POST['sourceL']));
    $targetLanguage = trim(strip_tags($_POST['targetL']));

    $sourceTexte = trim(strip_tags($_POST['sourceTexte']));

    if($sourceLanguage == "auto"){
        $sourceLanguage = $gApi->detect($sourceTexte);
    }

    if($sourceLanguage == ""){
        $error = "source language must be set";
    }
    if($targetLanguage == ""){
        $error = "target language must be set";
    }
    if($sourceTexte == ""){
        $error = "we can't translate without a text...";
    }

    if(!empty($sourceLanguage) && !empty($targetLanguage) && !empty($sourceTexte)){
        $targetTexte = $gApi->translate($sourceLanguage,$targetLanguage,$sourceTexte);
    }
    
}
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

        .contentBx{
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
            <?php if(!empty($error)):?>
                <p class="alert alert-danger"><?= $error?></p>
            <?php endif ?>
            <form action="" method="post">
                <div class="contentBx">
                    <div class="Bx">
                    <h4>Source language</h4>
                    <select name="sourceL" class="form-select">
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
                </div>
                
                <input type="submit" value="Translate" name="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>

</html>