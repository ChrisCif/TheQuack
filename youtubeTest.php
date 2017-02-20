<?php include "settingPHP/header.php" ?>

<h1>Title:</h1>
<p id='appendTitle'></p>

<h1>Description:</h1>
<p id='appendDescription'></p>

<script>
var youTubeURL = 'http://gdata.youtube.com/feeds/api/videos/Ktbhw0v186Q?v=2&alt=json&prettyprint=true';
var json = (function() {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': youTubeURL,
        'dataType': "json",
        'success': function(data) {
            json = data;
        }
    });
    return json;
})();

$('#appendTitle').append(json.entry.title.$t);
$('#appendDescription').append(json.entry.media$group.media$description.$t);

//console.log(json.entry.title.$t);

</script>

<?php include "settingPHP/footer.php" ?>