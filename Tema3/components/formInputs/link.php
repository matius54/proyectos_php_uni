<?php
    if(!isset($linkText))
        $linkText = "link";
    if(!isset($href))
        $href = "#";
?>
<a class="button" href="<?php echo $href ?>"><?php echo $linkText ?></a>