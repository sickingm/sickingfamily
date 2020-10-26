<?php
    identifier_comment("BEGIN ".__FILE__); 
?>
<div id="culture-page">
    <div id="culture-title">
        <h1>The Culture Page</h1>
        <h2>Great works of high class literature and art<br>authored by Sicking Family Members</h2>
    </div>
    <div id="culture-contents">
        <?php
            if (isset($_GET["opus"])){
                echo file_get_contents($_GET["opus"]);
            } else {
                require "./no_opus.php";
            }
        ?>
    </div>
    <div id="culture-toc" >
        <?PHP require "culture_toc.php"; ?>
    </div>
</div>

<?php
    identifier_comment("END ".__FILE__);