<?php

namespace App\Plugins\MarketDays;


use App\Http\Controllers\Controller;
use App\Plugins\MarketDays\Functions\MarketDays;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\MarketDays\Model\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketDaysController extends Controller
{

    use MarketDays;

    /*************************** Market Days ***************************/

    public function listMarketDays()
    {
        return view('admin.elements.table', ['list' => MarketDay::withTrashed()->get(), 'tableHeaders' => $this->getList(), 'header' => 'Market Days']);
    }

    public function editMarketDay($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => MarketDay::withTrashed()->findOrFail($id)]);
    }


    public function closestDay()
    {
        return $this->getClosestMarketDay() ?: "No Market Days Available";
    }

    public function getEditName($id)
    {
        return MarketDay::withTrashed()->findOrFail($id)->marketDay[config('app.locale')];
    }

    public function changeState($id)
    {

        if ($md = MarketDay::find($id)) {
            $md->delete();

            return ['status' => true, 'newState' => true, "message" => 'Market Day Disabled'];
        }

        if ($md = MarketDay::onlyTrashed()->findOrFail($id)) {
            $md->restore();

            return ['status' => true, 'newState' => true, "message" => 'Market Day Enabled'];
        }
    }

    public function storeMarketDay(Request $request, $id)
    {

        $request->validate(
            [
                'hideBeforeHours' => 'regex:/[0-9]{1,2}:[0-9]{2}/',
                'hideBeforeDays'  => 'numeric|max:7',

            ],
            [
                'hideBeforeHours.regex'  => 'Format should be xx:xx',
                'hideBeforeDays.numeric' => 'Days should be number',
                'hideBeforeDays.max'     => 'Order Can not be closed 7 days earlier',
            ]);

        $md = MarketDay::withTrashed()->findOrFail($id);

        $md->fill(request(['marketDay', 'hideBeforeDays', 'hideBeforeHours']));
        if ($md->save()) {
            return redirect(route('marketdays'))->with('message', ["msg" => 'Market Day Saved']);
        }

        return redirect()->back();

    }

    /*************************** Vacations ***************************/

    public function listVacationDays()
    {
        return view('admin.elements.table', ['list' => Vacation::all(), 'tableHeaders' => $this->getVacationList(), "header" => "Vacations", 'idField' => 'vacation_date', 'destroyName' => 'Vacation at']);
    }

    public function addVacationDay()
    {
        return view('admin.elements.form', ['formElements' => $this->vacationForm(), 'content' => new Vacation()]);
    }

    public function storeVacationDay()
    {

        Vacation::firstOrCreate(['vacation_date' => Carbon::createFromFormat('m/d/Y', request('vacation_date'))->format('Y-m-d')]);

        return redirect(route('vacations'))->with('message', ["msg" => "Vacation day saved"]);
    }

    public function deleteVacationDay($id)
    {
        $result = Vacation::find($id)->forceDelete();
        $result = ['status' => $result, "message" => $result ? "Vacation Day Deleted" : "Error Deleting Vacation day"];

        return $result;
    }
}