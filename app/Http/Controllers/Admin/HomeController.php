<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Visitor;
use App\Services\ProviderBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{


    public function index()
    {
        $allCustomersCount = Customer::count();
        $inProcessCustomersCount = Customer::withCount('visits')->having('visits_count', '<', 30)->count();
        $inCompleteCustomersCount = Customer::withCount('visits')->having('visits_count', '>=', 30)->count();
        $inFirstPhaseCustomersCount = Customer::withCount('visits')->having('visits_count', '<=', 10)->count();
        $inSecondPhaseCustomersCount = Customer::withCount('visits')->having('visits_count', '<=', 20)->having('visits_count', '>', 10)->count();
        $inThirdPhaseCustomersCount = Customer::withCount('visits')->having('visits_count', '<', 30)->having('visits_count', '>', 20)->count();
        $prescriptionsCustomersCount = Customer::whereHas('prescriptions',function($q){
            $q->where('status',1);
        })->count();
        $doctorsCount = User::where('role','doctor')->count();
        $receptionsCount = User::where('role','reception')->count();
        $psychologistsCount = User::where('role','clinic')->where('clinic_type','psychologist')->count();
        $familiesCount = User::where('role','clinic')->where('clinic_type','family')->count();
        $religiousCount = User::where('role','clinic')->where('clinic_type','religious')->count();

        $inCompleteCustomers = Customer::withCount('visits')->having('visits_count', '>=', 30)->get();
        $customerStates = [];
        foreach ($inCompleteCustomers as $inCompleteCustomer) {
            if ($inCompleteCustomer->third_phase_result['first'])
                $customerStates[] = trim($inCompleteCustomer->third_phase_result['first']);
        }
        return response()->json([
            'allCustomersCount' => $allCustomersCount,
            'inProcessCustomersCount' => $inProcessCustomersCount,
            'inCompleteCustomersCount' => $inCompleteCustomersCount,
            'inFirstPhaseCustomersCount' => $inFirstPhaseCustomersCount,
            'inSecondPhaseCustomersCount' => $inSecondPhaseCustomersCount,
            'inThirdPhaseCustomersCount' => $inThirdPhaseCustomersCount,
            'prescriptionsCustomersCount' => $prescriptionsCustomersCount,
            'doctorsCount' => $doctorsCount,
            'receptionsCount' => $receptionsCount,
            'psychologistsCount' => $psychologistsCount,
            'familiesCount' => $familiesCount,
            'religiousCount' => $religiousCount,
            'customerStates' => $this->countOccurrences($customerStates),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login/');
    }
    private function countOccurrences($inputArray) {
        $result = array();

        foreach ($inputArray as $item) {
            if (array_key_exists($item, $result)) {
                $result[$item]++;
            } else {
                $result[$item] = 1;
            }
        }

        return $result;
    }
}
