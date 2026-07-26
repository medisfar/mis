<?php

namespace App\Livewire;

use Livewire\Component;

class Calendar extends Component
{
    public $display = '0';
    public $firstNumber = null;
    public $operator = null;
    public $waitingForOperand = false;
    public $expression = '';

    protected $rules = [
        'display' => 'string',
    ];

    public function appendDigit($digit)
    {
        if ($this->waitingForOperand) {
            $this->display = $digit;
            $this->waitingForOperand = false;
        } else {
            $this->display = ($this->display === '0' && $digit !== '.') ? $digit : $this->display . $digit;
        }
        
        $this->updateExpression();
    }

    public function appendDecimal()
    {
        if ($this->waitingForOperand) {
            $this->display = '0.';
            $this->waitingForOperand = false;
        } elseif (strpos($this->display, '.') === false) {
            $this->display .= '.';
        }
        
        $this->updateExpression();
    }

    public function setOperator($op)
    {
        if ($this->operator && !$this->waitingForOperand) {
            $this->calculate();
        }
        
        $this->firstNumber = floatval($this->display);
        $this->operator = $op;
        $this->waitingForOperand = true;
        $this->updateExpression($op);
    }

    public function calculate()
    {
        if (!$this->operator || $this->waitingForOperand) {
            return;
        }

        $secondNumber = floatval($this->display);
        $result = null;

        switch ($this->operator) {
            case '+':
                $result = $this->firstNumber + $secondNumber;
                break;
            case '-':
                $result = $this->firstNumber - $secondNumber;
                break;
            case '*':
                $result = $this->firstNumber * $secondNumber;
                break;
            case '/':
                if ($secondNumber != 0) {
                    $result = $this->firstNumber / $secondNumber;
                } else {
                    $this->display = 'Error';
                    $this->resetCalculator();
                    return;
                }
                break;
            case '%':
                $result = $this->firstNumber % $secondNumber;
                break;
        }

        $this->display = (string) round($result, 10);
        $this->firstNumber = null;
        $this->operator = null;
        $this->waitingForOperand = true;
        $this->expression = $this->display;
    }

    public function clearAll()
    {
        $this->resetCalculator();
        $this->updateExpression();
    }

    public function clearEntry()
    {
        $this->display = '0';
        $this->waitingForOperand = false;
        $this->updateExpression();
    }

    public function backspace()
    {
        if ($this->waitingForOperand) {
            return;
        }
        
        if (strlen($this->display) > 1) {
            $this->display = substr($this->display, 0, -1);
        } else {
            $this->display = '0';
        }
        
        $this->updateExpression();
    }

    public function toggleSign()
    {
        $value = floatval($this->display);
        $this->display = (string) ($value * -1);
        $this->updateExpression();
    }

    public function percentage()
    {
        $value = floatval($this->display);
        $this->display = (string) ($value / 100);
        $this->updateExpression();
    }

    private function resetCalculator()
    {
        $this->display = '0';
        $this->firstNumber = null;
        $this->operator = null;
        $this->waitingForOperand = false;
        $this->expression = '';
    }

    private function updateExpression($newOp = null)
    {
        if ($this->firstNumber !== null && $this->operator) {
            $opSymbol = $this->getOperatorSymbol($this->operator);
            $this->expression = $this->firstNumber . ' ' . $opSymbol . ' ' . $this->display;
        } else {
            $this->expression = $this->display;
        }
    }

    private function getOperatorSymbol($op)
    {
        return match($op) {
            '+' => '+',
            '-' => '−',
            '*' => '×',
            '/' => '÷',
            '%' => '%',
            default => $op,
        };
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}