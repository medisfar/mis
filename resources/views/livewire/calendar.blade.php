<div>
    <style>
        .calculator-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.4);
            max-width: 400px;
            margin: 0 auto;
        }

        .calculator-display {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 1.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: right;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .calculator-expression {
            font-size: 0.85rem;
            color: #94a3b8;
            min-height: 1.5rem;
            word-break: break-all;
        }

        .calculator-result {
            font-size: 2.5rem;
            font-weight: 600;
            color: #f1f5f9;
            font-family: 'Inter', monospace;
            word-break: break-all;
        }

        .calculator-buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem;
        }

        .calc-btn {
            background: rgba(30, 41, 59, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1rem;
            padding: 1rem 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: #e2e8f0;
            transition: all 0.2s ease;
            cursor: pointer;
            text-align: center;
        }

        .calc-btn:hover {
            background: rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
        }

        .calc-btn:active {
            transform: translateY(0);
        }

        .calc-btn-operator {
            background: rgba(59, 130, 246, 0.2);
            color: #7dd3fc;
        }

        .calc-btn-operator:hover {
            background: #3b82f6;
            color: white;
        }

        .calc-btn-equals {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
        }

        .calc-btn-equals:hover {
            background: linear-gradient(135deg, #3b82f6, #6366f1);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .calc-btn-clear {
            background: rgba(220, 38, 38, 0.2);
            color: #f87171;
        }

        .calc-btn-clear:hover {
            background: #dc2626;
            color: white;
        }

        .calc-btn-special {
            background: rgba(139, 92, 246, 0.2);
            color: #c4b5fd;
        }

        .calc-btn-special:hover {
            background: #7c3aed;
            color: white;
        }

        .span-2 {
            grid-column: span 2;
        }

        @media (max-width: 480px) {
            .calculator-card {
                padding: 1rem;
            }
            .calc-btn {
                padding: 0.75rem 0.25rem;
                font-size: 1rem;
            }
            .calculator-result {
                font-size: 1.8rem;
            }
        }
    </style>

    <div class="calculator-card">
        <!-- Display -->
        <div class="calculator-display">
            <div class="calculator-expression">
                @if($expression && $expression != $display)
                    {{ $expression }}
                @else
                    &nbsp;
                @endif
            </div>
            <div class="calculator-result">
                {{ $display }}
            </div>
        </div>

        <!-- Buttons -->
        <div class="calculator-buttons">
            <!-- Row 1 -->
            <div wire:click="clearAll" class="calc-btn calc-btn-clear">
                <i class="bi bi-backspace"></i> AC
            </div>
            <div wire:click="clearEntry" class="calc-btn calc-btn-clear">
                CE
            </div>
            <div wire:click="percentage" class="calc-btn calc-btn-special">
                %
            </div>
            <div wire:click="setOperator('/')" class="calc-btn calc-btn-operator">
                ÷
            </div>

            <!-- Row 2 -->
            <div wire:click="appendDigit(7)" class="calc-btn">7</div>
            <div wire:click="appendDigit(8)" class="calc-btn">8</div>
            <div wire:click="appendDigit(9)" class="calc-btn">9</div>
            <div wire:click="setOperator('*')" class="calc-btn calc-btn-operator">
                ×
            </div>

            <!-- Row 3 -->
            <div wire:click="appendDigit(4)" class="calc-btn">4</div>
            <div wire:click="appendDigit(5)" class="calc-btn">5</div>
            <div wire:click="appendDigit(6)" class="calc-btn">6</div>
            <div wire:click="setOperator('-')" class="calc-btn calc-btn-operator">
                −
            </div>

            <!-- Row 4 -->
            <div wire:click="appendDigit(1)" class="calc-btn">1</div>
            <div wire:click="appendDigit(2)" class="calc-btn">2</div>
            <div wire:click="appendDigit(3)" class="calc-btn">3</div>
            <div wire:click="setOperator('+')" class="calc-btn calc-btn-operator">
                +
            </div>

            <!-- Row 5 -->
            <div wire:click="toggleSign" class="calc-btn calc-btn-special">
                ±
            </div>
            <div wire:click="appendDigit(0)" class="calc-btn">0</div>
            <div wire:click="appendDecimal" class="calc-btn">.</div>
            <div wire:click="calculate" class="calc-btn calc-btn-equals">
                =
            </div>
        </div>
        
        <!-- Optional: Backspace button separate row or add as extra -->
        <div class="mt-3">
            <div wire:click="backspace" class="calc-btn calc-btn-special w-100" style="grid-column: span 1;">
                <i class="bi bi-arrow-left"></i> Backspace
            </div>
        </div>
    </div>
</div>