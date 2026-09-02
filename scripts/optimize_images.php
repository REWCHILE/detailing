<?php

// Image optimization script for High Contrast Detailing Center
// Converts testimonial images to lightweight WebP, resizes the massive logo,
// and recompresses heavy home backgrounds.

function optimizeImageToWebp($srcPath, $destPath, $maxWidth = 1200, $quality = 82) {
    if (!file_exists($srcPath)) {
        echo "Source not found: $srcPath\n";
        return false;
    }

    $info = getimagesize($srcPath);
    if (!$info) {
        echo "Could not get image size for: $srcPath\n";
        return false;
    }

    $mime = $info['mime'];
    $width = $info[0];
    $height = $info[1];

    switch ($mime) {
        case 'image/png':
            $srcImg = imagecreatefrompng($srcPath);
            break;
        case 'image/jpeg':
            $srcImg = imagecreatefromjpeg($srcPath);
            break;
        case 'image/webp':
            $srcImg = imagecreatefromwebp($srcPath);
            break;
        default:
            echo "Unsupported format $mime for: $srcPath\n";
            return false;
    }

    if (!$srcImg) {
        echo "Failed to load image: $srcPath\n";
        return false;
    }

    // Preserve transparency for PNG/WebP
    imagealphablending($srcImg, true);
    imagesavealpha($srcImg, true);

    // Calculate proportional resize if exceeds maxWidth
    $newWidth = $width;
    $newHeight = $height;
    if ($width > $maxWidth) {
        $newWidth = $maxWidth;
        $newHeight = (int) round(($height * $maxWidth) / $width);
    }

    $dstImg = imagecreatetruecolor($newWidth, $newHeight);
    imagealphablending($dstImg, false);
    imagesavealpha($dstImg, true);
    $transparent = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
    imagefilledrectangle($dstImg, 0, 0, $newWidth, $newHeight, $transparent);

    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagewebp($dstImg, $destPath, $quality);

    imagedestroy($srcImg);
    imagedestroy($dstImg);

    $oldSize = round(filesize($srcPath) / 1024, 1);
    $newSize = round(filesize($destPath) / 1024, 1);
    $saved = round((1 - (filesize($destPath) / filesize($srcPath))) * 100, 1);
    echo "Optimized: " . basename($destPath) . " | {$oldSize}KB -> {$newSize}KB (saved {$saved}%)\n";
    return true;
}

// 1. Testimonials
$testimonialsDir = __DIR__ . '/../public/assets/images/testimonials';
$testimonialFiles = ['bmw_m4', 'mercedes_glc', 'porsche_911', 'audi_q5', 'tesla_model3'];
echo "--- Optimizing Testimonials ---\n";
foreach ($testimonialFiles as $f) {
    $src = "$testimonialsDir/$f.png";
    $dst = "$testimonialsDir/$f.webp";
    optimizeImageToWebp($src, $dst, 800, 80);
}

// 2. Main Logo (from 4726x4725 to 300x300 for crisp 2x retina display in a 40x40/70x70 container)
echo "\n--- Optimizing Main Logo ---\n";
$logoSrc = __DIR__ . '/../public/assets/logos/main-logo.png';
$logoDstWebp = __DIR__ . '/../public/assets/logos/main-logo.webp';
$logoDstPng = __DIR__ . '/../public/assets/logos/main-logo-optimized.png';
optimizeImageToWebp($logoSrc, $logoDstWebp, 300, 85);

// Also generate a compact 300px PNG fallback
if (file_exists($logoSrc)) {
    $info = getimagesize($logoSrc);
    $srcImg = imagecreatefrompng($logoSrc);
    $dstImg = imagecreatetruecolor(300, (int) round(($info[1] * 300) / $info[0]));
    imagealphablending($dstImg, false);
    imagesavealpha($dstImg, true);
    $transparent = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
    imagefilledrectangle($dstImg, 0, 0, 300, (int) round(($info[1] * 300) / $info[0]), $transparent);
    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, 300, (int) round(($info[1] * 300) / $info[0]), $info[0], $info[1]);
    imagepng($dstImg, $logoDstPng, 8);
    imagedestroy($srcImg);
    imagedestroy($dstImg);
    echo "Generated optimized PNG logo: " . round(filesize($logoDstPng) / 1024, 1) . "KB\n";
}

// 3. Home background WebP images
echo "\n--- Recompressing Home Images ---\n";
$homeDir = __DIR__ . '/../public/assets/images/home';
$homeImages = [
    'lavado.jpg' => 'lavado.webp',
    'nuestra-historia.jpg' => 'nuestra-historia.webp',
    'ceramico.jpg' => 'ceramico.webp',
    'correcion-pintura.jpg' => 'correcion-pintura.webp',
];

foreach ($homeImages as $srcFile => $dstFile) {
    $src = "$homeDir/$srcFile";
    $dst = "$homeDir/$dstFile";
    if (file_exists($src)) {
        optimizeImageToWebp($src, $dst, 1400, 80);
    }
}

echo "\nDone!\n";
