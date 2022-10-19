<?php
include_once('../constants.php');
if (isset($_POST['submit'])) {
    $url = trim(strip_tags($_POST['url']));

    if (!empty($url)) {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://t-one-youtube-converter.p.rapidapi.com/api/v1/createProcess?url=$url&format=mp3&responseFormat=json&lang=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: t-one-youtube-converter.p.rapidapi.com",
                "X-RapidAPI-Key: ".RAPID_API_KEY
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
        }
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

    <title>ytConv</title>
    <style>
        body{
            background-color: #eee;
        }
        .container{
            background-color: #fff;
            text-align: center;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 2em;
            border: 1px solid #eee;
            max-width: fit-content;
        }

        .row{
            margin: 0 auto;
        }

        img{
            object-fit: cover;
            width: 100%;
            height: fit-content;
        }

        .info{
            max-width: 100%;
            background-color: #eee;
        }

        .group {
            display: flex;
            flex-direction: column;
            padding: 2px;
        }

        .group p:first-of-type{
            font-size: 15px;
            font-weight: 400;
            color: #777;
            padding: 0;
            margin: 0;
        }

        .group p{
            font-weight: bold;
            font-size: 1.4rem;
        }

        .details{
            color: #333;
            text-align: justify;
        }

        a{
            color: green;
        }

        footer{
            display: flex;
            flex-direction: column;
            width: 100%;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Welcome on ytConv</h3>
        <p>Convert to mp3 video from youtube by url</p>
        <form action="" method="post" id="post">
            <input type="url" placeholder="enter youtube link" name="url">
            <input type="submit" value="convert" name="submit">
        </form>
        <div id="result" class="row" style="width: 100%;max-width:800px;">
            <?php if (isset($data) && !empty($data)) : ?>
                <img src="<?= $data['YoutubeAPI']['thumbUrl']; ?>" alt="" class="col-md-5">
                <div class="info col-md-7">
                <a class="btn btn-success" href="<?= $data['file']; ?>">Télécharger le fichier MP3</a>
                    <div class="group">
                        <p>Titre</p>
                        <p><?= $data['YoutubeAPI']['titolo']; ?></p>
                    </div>
                    <div class="group">
                        <p>Durée</p>
                        <p><?= $data['YoutubeAPI']['durata_video']; ?></p>
                    </div>
                    <div class="group">
                        <p>Vues</p>
                        <p><?= $data['YoutubeAPI']['contatore_visualizzazioni']; ?></p>
                    </div>
                    <p class="details">
                        <?= $data['YoutubeAPI']['descrizione']; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <footer>
        <p>&copy;2022 - ytConv - fabienbrou99</p>
        <p>To work, ytConv use <i>T-one Youtube Converter API</i></p>
    </footer>
</body>

</html>