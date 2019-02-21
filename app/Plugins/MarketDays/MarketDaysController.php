<?php

namespace App\Plugins\MarketDays;


use App\Plugins\Admin\AdminController;
use App\Plugins\MarketDays\Functions\MarketDays;
use App\Plugins\MarketDays\Model\MarketDay;
use App\Plugins\MarketDays\Model\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class MarketDaysController
 *
 * @package App\Plugins\MarketDays
 */
class MarketDaysController extends AdminController
{

    use MarketDays;

    /*************************** Market Days ***************************/

    public function listMarketDays()
    {
        return view('admin.elements.table', ['list' => MarketDay::withTrashed()->get(), 'tableHeaders' => $this->getList(), 'header' => 'Market Days']);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editMarketDay($id)
    {
        return view('admin.elements.tabForm', ['formElements' => $this->form(), 'content' => MarketDay::withTrashed()->findOrFail($id)]);
    }


    /**
     * @return string
     */
    public function closestDay()
    {
        return $this->getClosestMarketDay() ?: "No Market Days Available";
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getEditName($id)
    {
        return MarketDay::withTrashed()->findOrFail($id)->marketDay[config('app.locale')];
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function changeState($id)
    {
        /** @var MarketDay $md */
        if ($md = MarketDay::find($id)) {
            $md->delete();

            return ['status' => true, 'newState' => true, "message" => 'Market Day Disabled'];
        }

        if ($md = MarketDay::onlyTrashed()->findOrFail($id)) {
            $md->restore();

            return ['status' => true, 'newState' => true, "message" => 'Market Day Enabled'];
        }
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
        /** @var MarketDay $md */
        $md = MarketDay::withTrashed()->findOrFail($id);

        $md->fill(request(['marketDay', 'hideBeforeDays', 'hideBeforeHours']));
        if ($md->save()) {
            return redirect(route('marketdays'))->with('message', ["msg" => 'Market Day Saved']);
        }
        session()->flash("message", ['msg' => "Error saving Market Day", 'isError'=> true]);
        return redirect()->back();

    }

    /*************************** Vacations ***************************/

    public function listVacationDays()
    {
        return view('admin.elements.table', ['list' => Vacation::all(), 'tableHeaders' => $this->getVacationList(), "header" => "Vacations", 'idField' => 'vacation_date', 'destroyName' => 'Vacation at']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addVacationDay()
    {
        return view('admin.elements.form', ['formElements' => $this->vacationForm(), 'content' => new Vacation()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeVacationDay()
    {

        Vacation::firstOrCreate(['vacation_date' => Carbon::createFromFormat('m/d/Y', request('vacation_date'))->format('Y-m-d')]);

        return redirect(route('vacations'))->with('message', ["msg" => "Vacation day saved"]);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function deleteVacationDay($id)
    {
        $result = Vacation::find($id)->forceDelete();
        $result = ['status' => $result, "message" => $result ? "Vacation Day Deleted" : "Error Deleting Vacation day"];

        return $result;
    }
}