<?php
echo'<script>';

$this->script('js', 'functions/xhr', $data);

$this->script('js', 'canvas/tool/dataconverter', $data);
$this->script('js', 'canvas/tool/eventlistener');

$this->script('js', 'functions/data', $data);

$this->script('js', 'functions/color');

$this->script('js', 'canvas/class/path');
$this->script('js', 'canvas/class/camera');
$this->script('js', 'canvas/class/node');
$this->script('js', 'canvas/class/light');
$this->script('js', 'canvas/class/tree');
$this->script('js', 'canvas/class/slice');
$this->script('js', 'canvas/class/map');

$this->script('js', 'canvas/overSeer');
$this->script('js', 'canvas/threeMain');

echo'</script>';
