<?php
declare(strict_types=1);

interface Downloadable
{
    public function download(): void;
}

class Book
{
    protected string $title;
    protected string $author;
    protected float $price;

    public function __construct(string $title, string $author, float $price)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Giá sách không được âm.");
        }

        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function displayInfo(): void
    {
        echo "Tên sách: {$this->title}" . PHP_EOL;
        echo "Tác giả: {$this->author}" . PHP_EOL;
        echo "Giá: " . number_format($this->price, 0, ',', '.') . " VND" . PHP_EOL;
    }
}

class Ebook extends Book implements Downloadable
{
    private float $fileSize;

    public function __construct(
        string $title,
        string $author,
        float $price,
        float $fileSize
    ) {
        parent::__construct($title, $author, $price);

        if ($fileSize <= 0) {
            throw new InvalidArgumentException("Kích thước file phải lớn hơn 0.");
        }

        $this->fileSize = $fileSize;
    }

    public function displayInfo(): void
    {
        parent::displayInfo();
        echo "Kích thước file: {$this->fileSize} MB" . PHP_EOL;
    }

    public function download(): void
    {
        echo "Đang tải ebook '{$this->title}'..." . PHP_EOL;
    }
}

$book = new Book("Lập trình PHP căn bản", "Nguyen Van A", 120_000);
$ebook = new Ebook("OOP trong PHP", "Tran Thi B", 80_000, 5.5);

echo "THÔNG TIN SÁCH IN" . PHP_EOL;
$book->displayInfo();

echo str_repeat("-", 35) . PHP_EOL;

echo "THÔNG TIN EBOOK" . PHP_EOL;
$ebook->displayInfo();
$ebook->download();
