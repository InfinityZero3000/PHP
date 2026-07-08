<?php
declare(strict_types=1);

class BankAccount
{
    private string $accountNumber;
    private string $accountHolder;
    private float $balance;

    public function __construct(
        string $accountNumber,
        string $accountHolder,
        float $initialBalance = 0
    ) {
        if ($initialBalance < 0) {
            throw new InvalidArgumentException("Số dư ban đầu không được âm.");
        }

        $this->accountNumber = $accountNumber;
        $this->accountHolder = $accountHolder;
        $this->balance = $initialBalance;
    }

    public function deposit(float $amount): void
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Số tiền nạp phải lớn hơn 0.");
        }

        $this->balance += $amount;
        echo "Đã nạp: " . number_format($amount, 0, ',', '.') . " VND" . PHP_EOL;
    }

    public function withdraw(float $amount): bool
    {
        if ($amount <= 0) {
            throw new InvalidArgumentException("Số tiền rút phải lớn hơn 0.");
        }

        if ($amount > $this->balance) {
            echo "Rút tiền thất bại: số dư không đủ." . PHP_EOL;
            return false;
        }

        $this->balance -= $amount;
        echo "Đã rút: " . number_format($amount, 0, ',', '.') . " VND" . PHP_EOL;
        return true;
    }

    public function displayBalance(): void
    {
        echo "Số tài khoản: {$this->accountNumber}" . PHP_EOL;
        echo "Chủ tài khoản: {$this->accountHolder}" . PHP_EOL;
        echo "Số dư: " . number_format($this->balance, 0, ',', '.') . " VND" . PHP_EOL;
    }
}

$account = new BankAccount("00123456789", "Nguyen Van A", 1_000_000);

$account->displayBalance();
echo str_repeat("-", 35) . PHP_EOL;

$account->deposit(500_000);
$account->withdraw(300_000);
$account->withdraw(2_000_000);

echo str_repeat("-", 35) . PHP_EOL;
$account->displayBalance();
