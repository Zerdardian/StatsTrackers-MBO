<div class="messages">
    <div class="succes"></div>
    <div class="error"></div>
</div>
<script src="/js/basis.js"></script>
<?php
if(file_exists("./js/$page.js")) {
    ?>
    <script src="./js/<?=$page?>.js"></script>
    <?php
}
?>
</body>
</html>