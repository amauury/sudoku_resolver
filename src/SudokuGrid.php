<?php

class SudokuGrid implements GridInterface
{
    public array $data;


    public static function loadFromFile($filepath): ?SudokuGrid{
        $json = json_decode(file_get_contents($filepath));
        return new SudokuGrid($json);
    }

    public function __construct(array $data){
        $this->data = $data;
    }

    public function get(int $rowIndex, int $columnIndex): int{
        $grid = $this->data;
        return $grid[$rowIndex][$columnIndex];

    }

    public function set(int $rowIndex, int $columnIndex, int $value): void{
        $grid = $this->data;
        $grid[$rowIndex][$columnIndex] = $value;
    }

    public function row(int $rowIndex): array{
        $grid = $this->data;
        return $grid[$rowIndex];
    }

    public function column(int $columnIndex): array{
        $grid = $this->data;
        $column = [];
        for ($i = 0; $i <= 8; $i++) {
            $column[] = $grid[$i][$columnIndex];
        }
        return $column;
    }

    public function square(int $squareIndex): array{
        $grid = $this->data;
        $row1 = intdiv($squareIndex, 3)*3;
        $row2 = intdiv($squareIndex, 3)*3 + 2;
        $column1 = ($squareIndex % 3) * 3;
        $column2 = ($squareIndex % 3) * 3 + 2;
        $squarelist = [];
        for ($i = $row1; $i <= $row2; $i++) {
            for ($j = $column1; $j <= $column2; $j++){
                $squarelist[] = $grid[$i][$j];
            }
    }
        return $squarelist;
    }

    public function display(): string{
        $grid = $this->data;
        $text = implode('', $grid[0]) . PHP_EOL . implode('', $grid[1]) . PHP_EOL .
         implode('', $grid[2]) . PHP_EOL . implode('', $grid[3]) . PHP_EOL .
        implode('', $grid[4]) . PHP_EOL . implode('', $grid[5]) . PHP_EOL . 
        implode('', $grid[6]) . PHP_EOL . implode('', $grid[7]) . PHP_EOL .
        implode('', $grid[8]);

        return($text);

    }

    public function isValueValidForPosition(int $rowIndex, int $columnIndex, int $value): bool{
        $grid = $this->data;
        if ($rowIndex == 0 or $rowIndex == 1 or $rowIndex == 2){
            if ($columnIndex == 0 or $columnIndex == 1 or $columnIndex == 2){
                $squareIndex = 0;
            }
            elseif($columnIndex == 3 or $columnIndex == 4 or $columnIndex == 5){
                $squareIndex = 1;
            }
            elseif($columnIndex == 6 or $columnIndex == 7 or $columnIndex == 8){
                $squareIndex = 2;
            }

        }
        elseif ($rowIndex == 3 or $rowIndex == 4 or $rowIndex == 5){
            if ($columnIndex == 0 or $columnIndex == 1 or $columnIndex == 2){
                $squareIndex = 3;
            }
            elseif($columnIndex == 3 or $columnIndex == 4 or $columnIndex == 5){
                $squareIndex = 4;
            }
            elseif($columnIndex == 6 or $columnIndex == 7 or $columnIndex == 8){
                $squareIndex = 5;
            }

        }
        elseif ($rowIndex == 6 or $rowIndex == 7 or $rowIndex == 8){
            if ($columnIndex == 0 or $columnIndex == 1 or $columnIndex == 2){
                $squareIndex = 6;
            }
            elseif($columnIndex == 3 or $columnIndex == 4 or $columnIndex == 5){
                $squareIndex = 7;
            }
            elseif($columnIndex == 6 or $columnIndex == 7 or $columnIndex == 8){
                $squareIndex = 8;
            }
            
        }

        $row_list = $this->row($rowIndex);
        $column_list = $this->column($columnIndex);
        $quare_list = $this->square($squareIndex);

        if (in_array($value, $row_list) or in_array($value,$column_list) or in_array($value,$quare_list)){
            return false;
        }
        else{
            return true;
        }

        return True;
    }

    public function getNextRowColumn(int $rowIndex, int $columnIndex): array{
        if ($columnIndex == 8){
            return [$rowIndex + 1, 0];
        }
        else{
            return [$rowIndex, $columnIndex + 1];
        }
    }

    public function isValid(): bool{
        $grid = $this->data;
        foreach ($grid as $row){
            if (in_array(0, $row)){
                return false;
            }
        }
        return true;

    }

    public function isFilled(): bool{
        $grid = $this->data;
        foreach ($grid as $row){
            if (in_array(0, $row)){
                return false;
            }
        }
        return true;

    }

}
