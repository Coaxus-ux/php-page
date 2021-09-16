<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4cc7aa02e4578a3c9933ef01d035880c
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Spipu\\Html2Pdf\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Spipu\\Html2Pdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/spipu/html2pdf/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Datamatrix' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/datamatrix.php',
        'PDF417' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/pdf417.php',
        'QRcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/barcodes/qrcode.php',
        'TCPDF' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf.php',
        'TCPDF2DBarcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_barcodes_2d.php',
        'TCPDFBarcode' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_barcodes_1d.php',
        'TCPDF_COLORS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_colors.php',
        'TCPDF_FILTERS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_filters.php',
        'TCPDF_FONTS' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_fonts.php',
        'TCPDF_FONT_DATA' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_font_data.php',
        'TCPDF_IMAGES' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_images.php',
        'TCPDF_IMPORT' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_import.php',
        'TCPDF_PARSER' => __DIR__ . '/..' . '/tecnickcom/tcpdf/tcpdf_parser.php',
        'TCPDF_STATIC' => __DIR__ . '/..' . '/tecnickcom/tcpdf/include/tcpdf_static.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4cc7aa02e4578a3c9933ef01d035880c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4cc7aa02e4578a3c9933ef01d035880c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4cc7aa02e4578a3c9933ef01d035880c::$classMap;

        }, null, ClassLoader::class);
    }
}
