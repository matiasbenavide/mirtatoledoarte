<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Constants;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Repositories\Admin\ParametersRepository;

class VacationsController extends Controller
{
    /**
     * @var ParametersRepository
     */
    protected $parametersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ParametersRepository $parametersRepository
    )
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
        $this->parametersRepository = $parametersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showVacations()
    {
        $task = 'vacations';
        $vacations = $this->parametersRepository->first()->vacations;

        return view('pages.admin.vacations')->with([
            'task' => $task,
            'vacations' => $vacations
        ]);
    }

    public function changeVacations(Request $request)
    {
        try {
            $this->validate($request, [
                'vacationsSwitch' => 'nullable|string',
            ]);
        } catch (ValidationException $e) {
            Log::error($e->getMessage(), $e->errors());
            return redirect()->back()->with('error', Constants::ERROR);
        }

        $priceUpdate = $this->parametersRepository->first()->price_update;

        if ($request->vacationsSwitch == "on")
        {
            $request->vacationsSwitch = 1;
        }
        else
        {
            $request->vacationsSwitch = 0;
        }

        try {
            DB::beginTransaction();
            $this->parametersRepository->update($this->mapData($request->vacationsSwitch, $priceUpdate), 1);
            $message = Constants::VACATIONS_SUCCESS;
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', Constants::ERROR);
        }

        return redirect()->back()->with('success', $message);

    }

    private function mapData($vacations, $priceUpdate)
    {
        $dataMapped = [
            'vacations' => $vacations,
            'price_update' => $priceUpdate
        ];

        return $dataMapped;
    }
}
