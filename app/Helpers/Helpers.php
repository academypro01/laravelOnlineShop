<?php

function make_slug($text) {
    $text = strtolower($text);
    $text = str_replace(['؟','?'], '', $text);
    return preg_replace('/\s+/u','-', trim($text));
}
