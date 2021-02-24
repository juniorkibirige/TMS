<?php
$img_dir = 'tbi/';
$images = scandir($img_dir);
$html = '<script src="//cdn.tms-dist.lan:433/styles/js/sliding_gallery.js" crossorigin="anonymous"></script>';
$total = count($images) - 2;
$count = 1;
if ($total == 0) {
    $html .= '<img src="/tests/slides/BarbedWire.jpg" alt="Barbed Wire" />
    <img src="/tests/slides/Feather.jpg" alt="Feather" />
    <img src="/tests/slides/DriftStuff.jpg" alt="Drift Stuff" />
    <img src="/tests/slides/Driftwood.jpg" alt="Driftwood" />
    <img src="/tests/slides/DriftwoodGuy.jpg" alt="Driftwood and Guy" />
    <img src="/tests/slides/GrassLight.jpg" alt="Grass and Light" />
    <img src="/tests/slides/PebbleAndShells.jpg" alt="Pebble and Shells" />
    <img src="/tests/slides/StickSea.jpg" alt="Stick and Sea" />
    <img src="/tests/slides/SeaweedGasmask.jpg" alt="Seaweed Gasmask" />
    <img src="/tests/slides/Surfers.jpg" alt="Surfers" />';
} else {
    foreach ($images as $img) {
        if ($img === '.' || $img === '..') {
            continue;
        }
        if ((preg_match('/.JPG/', $img)) || (preg_match('/.jpg/', $img)) || (preg_match('/.gif/', $img)) || (preg_match('/.tiff/', $img)) || (preg_match('/.png/', $img))
        ) {
            $i_s = $img_dir . $img;
            $i = 'includes/'.$img_dir . $img;
            list($w, $h) = getimagesize($i_s);
            setcookie($count, $w.' & '. $h);
            if ($h > $w) {
                // $sC = imagecreatefromjpeg(file($i));
                // $rI = imagerotate(file($i), -90, 0);
                // echo resourcebundle_get($i, true);
                // var_dump($i);
                // imagejpeg($rI, file($i));
                $html .= '
                <img src="' . $i . '" width="500px" height="400px" alt="' . file_ext($img) . '"/>';
            } else {
                $html .= '
                <img src="' . $i . '" width="500px" alt="' . file_ext($img) . '"></img>';
            }
            $count += 1;
        } else {
            continue;
        }
    }
}
echo $html;

function file_ext($strName)
{
    $ext = strrchr($strName, '.');
    if ($ext !== false) {
        $strName = substr($strName, 0, -strlen($ext));
    }
    return $strName;
}