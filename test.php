<?php
    $API_key = 'AIzaSyAdkxX9Be1-76Lz3E8ZsAg7v1V13Opju2w';
    $channelID = 'UCdMGYXL38w6htx6Yf9YJa-w';

    $maxResults = 20;

    //Get videos from YouTube ID by YouTube Data API
    $error = 'Video not found';

    try{
        $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/playlists?&order=title&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.'');
        
        if($apiData){
            $videoList = json_decode($apiData);
        }else{
            throw new Exception('Invalid API key or channel ID');
        }
    }catch(Exception $e){
        $error = $e -> getMessage();
    }

    $Target = array('ぷちセカ', 'もうすぐ1周年！カウントダウンストーリー', 'なつやすみラジオ', 
    'プロセカストーリーシアター', 'プロセカアフタートーク', '25時、ナイトラジオで。',
     '25時、ナイトコードで。スペシャル企画', 'ビビバスアーカイブ', 'MORE MORE JUMP！配信', 'セカイ・ステーション');

    $Option = '';
    $Num = 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>
    <h1>Videos</h1
    <div class="sidenav">
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                選單
            </button>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                <?php 
                foreach($Target as $Name){?>
                    <li><a class="dropdown-item"><?php echo $Name;?></a></li>
                <?php
                }?>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="video-container">
        <?php

           if (!empty($videoList->items)){
               foreach($videoList->items as $item){
                    if(isset($item->id)){
                        if (in_array($item->snippet->title, $Target)){
                    ?>
                        <div class="yvideo-box">
                            <iframe width="224" height="126" src="https://www.youtube.com/embed/playlist?list=<?php echo $item->id; ?>" 
                                frameborder="0" allowfullscreen></iframe>
                            <p style="font-size:30%"><?php echo $item->snippet->title; ?></p>
                       </div>

                    <?php
                        }
                    }
                }
            }else{
                echo '<p class="error">'.$error.'</p>';
            }
        ?>
        </div>
    </div>

</body>

</html>