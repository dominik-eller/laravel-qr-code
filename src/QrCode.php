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
    /**
     * Error correction level of the QR code.
     * It defines the tolerance of the QR code to damage or dirt.
     *
     * @var ErrorCorrectionLevel
     */
    protected ErrorCorrectionLevel $errorCorrectionLevel;

    /**
     * Size of the QR code in pixels.
     *
     * @var int
     */
    protected int $size = 300;

    /**
     * Foreground color of the QR code.
     * Represented as an array with RGB values.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $color = [0, 0, 0]; // Default to black

    /**
     * Background color of the QR code.
     * Represented as an array with RGB values.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $backgroundColor = [255, 255, 255]; // Default to white

    /**
     * Margin around the QR code.
     *
     * @var int
     */
    protected int $margin = 10;

    /**
     * Color for the top-left eye of the QR code.
     * Represented as an array with RGB values.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $topLeftEyeColor = [0, 0, 0];

    /**
     * Color for the top-right eye of the QR code.
     * Represented as an array with RGB values.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $topRightEyeColor = [0, 0, 0];

    /**
     * Color for the bottom-left eye of the QR code.
     * Represented as an array with RGB values.
     *
     * @var int[] An array containing RGB values (red, green, blue).
     */
    protected array $bottomLeftEyeColor = [0, 0, 0];

    /**
     * Output format of the QR code (e.g., PNG, SVG, EPS).
     *
     * @var string
     */
    protected string $format = 'png'; // Default format is PNG

    /**
     * QrCode constructor.
     * Initializes the error correction level to medium (M).
     */
    public function __construct()
    {
        $this->errorCorrectionLevel = ErrorCorrectionLevel::M(); // Default to medium
    }

    /**
     * Set the size of the QR code.
     *
     * @param int $size Size of the QR code in pixels.
     * @return $this
     */
    public function setSize(int $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Set the foreground color of the QR code.
     *
     * @param int[] $color Array containing RGB values for the foreground color.
     * @return $this
     */
    public function setColor(array $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Set the background color of the QR code.
     *
     * @param int[] $backgroundColor Array containing RGB values for the background color.
     * @return $this
     */
    public function setBackgroundColor(array $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Set the margin around the QR code.
     *
     * @param int $margin Margin size in pixels.
     * @return $this
     */
    public function setMargin(int $margin)
    {
        $this->margin = $margin;
        return $this;
    }

    /**
     * Set the error correction level of the QR code.
     *
     * @param string $level Error correction level: L (low), M (medium), Q (quartile), H (high).
     * @return $this
     * @throws \InvalidArgumentException If the provided error correction level is invalid.
     */
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

    /**
     * Set the color for the top-left eye of the QR code.
     *
     * @param int[] $color Array containing RGB values for the top-left eye color.
     * @return $this
     */
    public function setTopLeftEyeColor(array $color)
    {
        $this->topLeftEyeColor = $color;
        return $this;
    }

    /**
     * Set the color for the top-right eye of the QR code.
     *
     * @param int[] $color Array containing RGB values for the top-right eye color.
     * @return $this
     */
    public function setTopRightEyeColor(array $color)
    {
        $this->topRightEyeColor = $color;
        return $this;
    }

    /**
     * Set the color for the bottom-left eye of the QR code.
     *
     * @param int[] $color Array containing RGB values for the bottom-left eye color.
     * @return $this
     */
    public function setBottomLeftEyeColor(array $color)
    {
        $this->bottomLeftEyeColor = $color;
        return $this;
    }

    /**
     * Set the output format of the QR code (PNG, SVG, EPS).
     *
     * @param string $format Format of the output (png, svg, eps).
     * @return $this
     * @throws \InvalidArgumentException If the format is not supported.
     */
    public function setFormat(string $format)
    {
        if (!in_array($format, ['png', 'svg', 'eps'])) {
            throw new \InvalidArgumentException("Unsupported format: $format. Supported formats are: png, svg, eps.");
        }
        $this->format = strtolower($format);
        return $this;
    }

    /**
     * Get the size of the QR code.
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get the foreground color of the QR code.
     *
     * @return int[] Array containing RGB values for the foreground color.
     */
    public function getColor(): array
    {
        return $this->color;
    }

    /**
     * Get the background color of the QR code.
     *
     * @return int[] Array containing RGB values for the background color.
     */
    public function getBackgroundColor(): array
    {
        return $this->backgroundColor;
    }

    /**
     * Get the margin size of the QR code.
     *
     * @return int
     */
    public function getMargin(): int
    {
        return $this->margin;
    }

    /**
     * Get the error correction level of the QR code.
     *
     * @return ErrorCorrectionLevel
     */
    public function getErrorCorrectionLevel(): ErrorCorrectionLevel
    {
        return $this->errorCorrectionLevel;
    }

    /**
     * Get the color of the top-left eye of the QR code.
     *
     * @return int[] Array containing RGB values for the top-left eye.
     */
    public function getTopLeftEyeColor(): array
    {
        return $this->topLeftEyeColor;
    }

    /**
     * Get the color of the top-right eye of the QR code.
     *
     * @return int[] Array containing RGB values for the top-right eye.
     */
    public function getTopRightEyeColor(): array
    {
        return $this->topRightEyeColor;
    }

    /**
     * Get the color of the bottom-left eye of the QR code.
     *
     * @return int[] Array containing RGB values for the bottom-left eye.
     */
    public function getBottomLeftEyeColor(): array
    {
        return $this->bottomLeftEyeColor;
    }

    /**
     * Get the output format of the QR code (PNG, SVG, EPS).
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Abstract method to get the data for the QR code.
     * Must be implemented by concrete subclasses to provide the content (e.g., URL, text, etc.).
     *
     * @return string The data to encode into the QR code.
     */
    abstract public function getData(): string;

    /**
     * Generate the QR code as a binary string.
     *
     * @return string The binary content of the QR code image.
     */
    public function generate(): string
    {
        $backend = match ($this->format) {
            'svg' => new SvgImageBackEnd,
            'eps' => new EpsImageBackEnd,
            'png' => new ImagickImageBackEnd,
            default => new ImagickImageBackEnd, // Default is PNG
        };

        $topLeftEyeFill = EyeFill::uniform(new Rgb(...$this->topLeftEyeColor));
        $topRightEyeFill = EyeFill::uniform(new Rgb(...$this->topRightEyeColor));
        $bottomLeftEyeFill = EyeFill::uniform(new Rgb(...$this->bottomLeftEyeColor));

        $fill = Fill::withForegroundColor(
            new Rgb(...$this->backgroundColor),
            new Rgb(...$this->color),
            $topLeftEyeFill,
            $topRightEyeFill,
            $bottomLeftEyeFill
        );

        $style = new RendererStyle(
            $this->size,
            $this->margin,
            null,
            null,
            $fill
        );

        $renderer = new ImageRenderer($style, $backend);
        $writer = new Writer($renderer);

        return $writer->writeString($this->getData());
    }

    /**
     * Return the QR code as a Base64-encoded string with the appropriate data URI.
     *
     * @return string The Base64-encoded QR code, including the data URI.
     */
    public function toBase64(): string
    {
        $qrCodeBinary = $this->generate();
        $base64QrCode = base64_encode($qrCodeBinary);

        $mimeType = match ($this->format) {
            'svg' => 'image/svg+xml',
            'eps' => 'application/postscript',
            'png' => 'image/png',
            default => 'image/png',
        };

        return "data:{$mimeType};base64,{$base64QrCode}";
    }
}
