<?php
$surl = (isset($_GET['surl'])?$_GET['surl']:false);
if($surl!==false){
    $stream_url = $surl;
}else{
    $player_url = (isset($_GET['url'])?$_GET['url']:false);
    $player_content = file_get_contents($player_url);
    // $lines = explode("\n", $player_content);
    $find_start='id="radio_mp3_for_player" type="hidden" value="';
    $find_end='">';
    $pos = strpos($player_content, $find_start);
    $stream_url = substr($player_content,$pos+strlen($find_start), strlen($player_content) );
    // $stream_url =·
    $pos = strpos($stream_url, $find_end);
    $stream_url = substr($stream_url, 0, $pos);
}





// var_dump($stream_url); exit;
?>
<style>
h1 span, h2 span{ font-size:80%; background:#eee; color:#111; padding:5px 10px; font-weight: normal; }
#output-wrapper{margin-top:100px;}
</style>
<h1>Looking in <span><?php echo $player_url; ?></span></h1>
<h2>Loading from <span><?php echo $stream_url; ?></span></h2>

<h3>URL: </h3>
<form>
<p><input style="width:50%;" type="text" name="url" id="stream_url" value="<?php echo $player_url;?>" /></p>
<p><input style="width:50%;" type="submit" name="submit"/></p>
</form>
<div id="output-wrapper">
    <h3>Output - Stream Title:</h3>
    <textarea id="output" style="width:50%; height:200px"></textarea>
</div>


<script>window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>')</script>
<script>
$('form').bind('submit', function(){
    var stream_url = $(this).find('#stream_url').val();
    $.get('http://localhost/test-metadata-players/get.php?url='+stream_url, function(data){
        $('#output').text(data);
        console.log(data);
    });
    e.preventDefault();
});

    var stream_url = '<?php echo $stream_url;?>';
    if(stream_url!==''){
        $.get('http://localhost/test-metadata-players/get.php?url='+stream_url, function(data){
            $('#output').text(data);
            console.log(data);
        });
    }


</script>
