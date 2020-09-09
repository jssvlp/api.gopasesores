<?php


namespace App\Repositories;


use App\Client;
use App\Company;
use App\People;
use App\Policy;
use App\Repositories\Interfaces\IStatisticsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsRepository implements IStatisticsRepository
{

    public function all()
    {
        $clients = $this->clients();
        $birthdays = $this->clientsBirthdayOnThisWeek();
        $policies = $this->policies();
        $commissioners = $this->commissioners();

        return ['clients' => $clients, 'birthdays' => $birthdays,'policies' => $policies, 'commissioners' =>$commissioners];
    }

    private function clients(){
        $clients = Client::all()->count();
        $peoples = People::all()->count();
        $companies = Company::all()->count();

        $by_type = ['people' => $peoples, 'company' =>$companies];

        //select  MONTH(c.date_of_admission) month,count(c.id) as cnt from clients
        // c group by MONTH(c.date_of_admission);
        $thisYear = Carbon::today()->year;
        $query = "SELECT TMeses.Mes,T1.total_mes FROM
             (SELECT 1 as IdMes , 'Enero'     as Mes UNION
             SELECT 2 as IdMes , 'Febrero'    as Mes UNION
             SELECT 3 as IdMes , 'Marzo'      as Mes UNION
             SELECT 4 as IdMes , 'Abril'      as Mes UNION
             SELECT 5 as IdMes , 'Mayo'       as Mes UNION
             SELECT 6 as IdMes , 'Junio'      as Mes UNION
             SELECT 7 as IdMes , 'Julio'      as Mes UNION
             SELECT 8 as IdMes , 'Agosto'     as Mes UNION
             SELECT 9 as IdMes , 'Septiembre' as Mes UNION
             SELECT 10 as IdMes, 'Octubre'    as Mes UNION
             SELECT 11 as IdMes, 'Noviembre'  as Mes UNION
             SELECT 12 as IdMes, 'Diciembre'  as Mes) TMeses
            LEFT JOIN
                (SELECT MONTH(c.date_of_admission) Mes, count(c.id) total_mes FROM clients c WHERE YEAR(c.date_of_admission)=".$thisYear." GROUP BY Mes) T1
            ON T1.Mes = TMeses.idMes;";

        $result = DB::select($query);

        $collection = collect($result);

        $labels = $collection->map(function($item, $key){
            return $item->Mes;

        });

        $series = $collection->map(function($item,$key){
            return $item->total_mes == null ? 0 : $item->total_mes;
        });
        $struct = [
          'labels' => $labels,
          'series' =>[
              $series
          ]
        ];


        return [
            'total' => $clients,
            'by_type' => $by_type,
            'new_by_month_in_this_year' => $struct
        ];
    }

    private function clientsBirthdayOnThisWeek()
    {
        $month = Carbon::now()->month;

        return DB::table('people')
            ->wheremonth('birth_date',$month)
            ->select(['people.id','people.first_name','people.last_name','people.birth_date'])
            ->get();
    }

    private function policies()
    {
        $total = Policy::all()->count();

        $byInsurances = DB::table('policies')
                        ->join('branch_insurance','policies.branch_id','=','branch_insurance.branch_id')
                        ->join('insurances','branch_insurance.insurance_id','=','insurances.id')
                        ->groupBy('insurances.name')
                        ->select('insurances.name',DB::raw('COUNT(policies.id) as cnt'))
                        ->get();


        $byBranches = DB::table('policies')
            ->join('branches','policies.branch_id','=','branches.id')
            ->groupBy('branches.name')
            ->select('branches.name',DB::raw('COUNT(policies.id) as cnt'))
            ->get();

        //select count(p.id) quantity from policies p
        // join sinisters s on p.id = s.policy_id where s.status != 'Pagado';
        $withOpenedSinister = DB::table('policies')
            ->join('sinisters','policies.id','sinisters.policy_id')
            ->where('sinisters.status','!=','Pagado')
            ->select(DB::raw('count(policies.id) as withOpenedSinister'))
            ->get();


        return [
            'total' => $total,
            'by_insurances' => $byInsurances,
            'by_branches' => $byBranches,
            'with_opened_sinister' => $withOpenedSinister[0]->withOpenedSinister
        ];
    }

    private function commissioners()
    {
        $total =  DB::table('employees')
            ->select(DB::raw('count(employees.id) as cnt'))
            ->where('commissioner','=', 1)
            ->get();

        return  $total[0]->cnt;

    }
}
