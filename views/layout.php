<?php
// views/layout.php

include 'header.php';

if (isset($page_view)) {
    include $page_view;
}

include 'footer.php';
?>
