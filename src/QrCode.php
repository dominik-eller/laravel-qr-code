<?php

namespace Deller\QrCode;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\EpsImageBackEnd;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\EyeFill;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

abstract class QrCode
{
    protected ErrorCorrectionLevel $errorCorrectionLevel;

    protected int $size = 300;

    /**
     * Foreground color of the qr code
     * Array representing the RGB color values.
     * Each element in the array corresponds to the intensity of
     * Red, Green, and Blue channels respectively.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $color = [0, 0, 0]; // Default to black

    /**
     * Background color of the qr code
     * Array representing the RGB color values.
     * Each element in the array corresponds to the intensity of
     * Red, Green, and Blue channels respectively.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $backgroundColor = [255, 255, 255]; // Default to white

    protected int $margin = 10;

    protected array $topLeftEyeColor = [0, 0, 0];

    protected array $topRightEyeColor = [0, 0, 0];

    protected array $bottomLeftEyeColor = [0, 0, 0];

    protected string $format = 'png'; // Default format is PNG

    public function __construct()
    {
        $this->errorCorrectionLevel = ErrorCorrectionLevel::M(); // Default to medium
    }

    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    public function setColor(array $color)
    {
        $this->color = $color;

        return $this;
    }

    public function setBackgroundColor(array $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function setMargin(int $margin)
    {
        $this->margin = $margin;

        return $this;
    }

    public function setErrorCorrectionLevel(string $level)
    {
        switch (strtoupper($level)) {
            case 'L':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::L();
                break;
            case 'M':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::M();
                break;
            case 'Q':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::Q();
                break;
            case 'H':
                $this->errorCorrectionLevel = ErrorCorrectionLevel::H();
                break;
            default:
                throw new \InvalidArgumentException("Invalid error correction level: $level");
        }

        return $this;
    }

    public function setTopLeftEyeColor(array $color)
    {
        $this->topLeftEyeColor = $color;

        return $this;
    }

    public function setTopRightEyeColor(array $color)
    {
        $this->topRightEyeColor = $color;

        return $this;
    }

    public function setBottomLeftEyeColor(array $color)
    {
        $this->bottomLeftEyeColor = $color;

        return $this;
    }

    // Method to set the output format (PNG, SVG, EPS)
    public function setFormat(string $format)
    {
        if (! in_array($format, ['png', 'svg', 'eps'])) {
            throw new \InvalidArgumentException("Unsupported format: $format. Supported formats are: png, svg, eps.");
        }
        $this->format = strtolower($format);

        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getColor(): array
    {
        return $this->color;
    }

    public function getMargin(): int
    {
        return $this->margin;
    }

    public function getBackgroundColor(): array
    {
        return $this->backgroundColor;
    }

    public function getErrorCorrectionLevel(): ErrorCorrectionLevel
    {
        return $this->errorCorrectionLevel;
    }

    public function getTopLeftEyeColor(): array
    {
        return $this->topLeftEyeColor;
    }

    public function getTopRightEyeColor(): array
    {
        return $this->topRightEyeColor;
    }

    public function getBottomLeftEyeColor(): array
    {
        return $this->bottomLeftEyeColor;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    abstract public function getData(): string;

    public function generate(): string
    {
        // Choose the renderer backend based on the format
        $backend = match ($this->format) {
            'svg' => new SvgImageBackEnd,
            'eps' => new EpsImageBackEnd,
            'png' => new ImagickImageBackEnd,
            default => new ImagickImageBackEnd, // Default is PNG
        };

        // Create the eye fills for the three QR code corners
        $topLeftEyeFill = EyeFill::uniform(new Rgb(...$this->topLeftEyeColor));
        $topRightEyeFill = EyeFill::uniform(new Rgb(...$this->topRightEyeColor));
        $bottomLeftEyeFill = EyeFill::uniform(new Rgb(...$this->bottomLeftEyeColor));

        // Create the fill object for the foreground and background colors
        $fill = Fill::withForegroundColor(
            new Rgb(...$this->backgroundColor),  // Background color
            new Rgb(...$this->color),            // Foreground color
            $topLeftEyeFill,                     // Top-left eye fill
            $topRightEyeFill,                    // Top-right eye fill
            $bottomLeftEyeFill                   // Bottom-left eye fill
        );

        // Create the RendererStyle object with proper parameters
        $style = new RendererStyle(
            $this->size,        // Module size
            $this->margin,      // Margin
            null,        // No custom module style
            null,          // No custom eye design (only using eye colors)
            $fill               // Pass the custom fill object
        );

        // Create the ImageRenderer with the selected backend
        $renderer = new ImageRenderer(
            $style,
            $backend
        );

        // Create the Writer with the renderer
        $writer = new Writer($renderer);

        // Generate the QR code with the data provided and return as string
        return $writer->writeString($this->getData());
    }

    // Method to return the QR code as a Base64-encoded string
    public function toBase64(): string
    {
        // Generate the QR code in binary format
        $qrCodeBinary = $this->generate();

        // Encode the binary data to Base64
        $base64QrCode = base64_encode($qrCodeBinary);

        // Determine the MIME type based on the format
        $mimeType = match ($this->format) {
            'svg' => 'image/svg+xml',
            'eps' => 'application/postscript',
            'png' => 'image/png',
            default => 'image/png',  // Default is PNG
        };

        // Return the Base64 string with the correct data URI
        return "data:{$mimeType};base64,{$base64QrCode}";
    }
}
