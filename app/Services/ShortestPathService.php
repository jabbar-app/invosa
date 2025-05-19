<?php

namespace App\Services;

class ShortestPathService
{
    private array $triangle;
    private int $numRows;
    private array $dpTable;
    private array $pathIndices;

    public function __construct(array $triangle)
    {
        $this->triangle = $triangle;
        $this->numRows = count($triangle);
        $this->dpTable = [];
        $this->pathIndices = [];
    }

    public function findShortestPath(): array
    {
        if ($this->numRows === 0) {
            return ['sum' => 0, 'path' => 'N/A', 'path_nodes' => []];
        }
        if ($this->numRows === 1) {
            return [
                'sum' => $this->triangle[0][0],
                'path' => 'n11',
                'path_nodes' => [['row' => 0, 'col' => 0, 'value' => $this->triangle[0][0]]]
            ];
        }

        $this->dpTable = $this->triangle;

        for ($i = $this->numRows - 2; $i >= 0; $i--) {
            $this->pathIndices[$i] = [];
            for ($j = 0; $j <= $i; $j++) {

                $leftSum = $this->dpTable[$i + 1][$j];
                $rightSum = $this->dpTable[$i + 1][$j + 1];

                if ($leftSum < $rightSum) {
                    $this->dpTable[$i][$j] = $this->triangle[$i][$j] + $leftSum;
                    $this->pathIndices[$i][$j] = $j;
                } else {
                    $this->dpTable[$i][$j] = $this->triangle[$i][$j] + $rightSum;
                    $this->pathIndices[$i][$j] = $j + 1;
                }
            }
        }

        $minimumSum = $this->dpTable[0][0];
        $pathNodes = $this->reconstructPath();
        $pathString = $this->formatPathString($pathNodes);

        return [
            'sum' => $minimumSum,
            'path' => $pathString,
            'path_nodes' => $pathNodes,
        ];
    }

    private function reconstructPath(): array
    {
        $path = [];
        if ($this->numRows === 0) return $path;

        $currentRow = 0;
        $currentCol = 0;

        $path[] = [
            'row' => $currentRow,
            'col' => $currentCol,
            'value' => $this->triangle[$currentRow][$currentCol]
        ];

        while ($currentRow < $this->numRows - 1) {
            $nextCol = $this->pathIndices[$currentRow][$currentCol];
            $currentRow++;
            $currentCol = $nextCol;

            $path[] = [
                'row' => $currentRow,
                'col' => $currentCol,
                'value' => $this->triangle[$currentRow][$currentCol]
            ];
        }
        return $path;
    }

    private function formatPathString(array $pathNodes): string
    {
        if (empty($pathNodes)) return 'N/A';

        return implode(' + ', array_map(function ($node) {

            return 'n' . ($node['row'] + 1) . ($node['col'] + 1);
        }, $pathNodes));
    }
}
