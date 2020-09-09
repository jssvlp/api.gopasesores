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
        $new_clients_by_month = Db::table('clients')
                            ->whereYear('clients.date_of_admission', $thisYear)
                            ->groupBy('clients.date_of_admission')
                            ->select(DB::raw('MONTH(clients.date_of_admission) AS month'),DB::raw('count(clients.id) as cnt'))
                            ->get();


        return [
            'total' => $clients,
            'by_type' => $by_type,
            'new_by_month_in_this_year' => $new_clients_by_month
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
