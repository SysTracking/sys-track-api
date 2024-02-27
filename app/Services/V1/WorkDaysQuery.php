<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class WorkDaysQuery {
    protected $safeParams = [
        'userId' => ['eq'],
        'date' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'userId' => 'user_id',
        'date' => 'date'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<'
    ];

    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
