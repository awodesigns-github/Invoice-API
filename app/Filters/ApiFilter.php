<?php
namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request)
    {
        // building an actual query to pass into eloquent, since eloquent where() accepts arrays
        $eloQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]]; // $eloquery is not the same as $eloquery[]
                }
            }
        }

        return $eloQuery;
    }


}

