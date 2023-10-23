<?php
namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{
    protected $safeParms = [
        "customerId" => ['eq', 'gt', 'lt'],
        "amount" => ['eq', 'gt', 'lt'],
        "status" => ['eq', 'ne'],
        "billedDate" => ['eq', 'lt', 'gt'],
        "paidDate" => ['eq', 'lt', 'gt']
    ];
    protected $columnMap = [
        "paidDate" => "paid_date",
        "billedDate" => "billed_date",
        "customerId" => "customer_id"
    ];
    protected $operatorMap = [
        "eq" => "=",
        "gt" => ">",
        "lt" => "<",
        "ne" => "!="
    ];
}
