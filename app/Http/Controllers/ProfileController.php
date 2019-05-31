<?php

namespace App\Http\Controllers;


use App\EmailChange;
use App\Http\Requests\Profile;
use App\Plugins\Orders\Model\OrderHeader;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'registered']);
    }

    public function index()
    {
        return view('frontend.pages.profile', ['user' => Auth::user(), 'pageTitle' => _t('translations.profile')]);
    }

    public function store(Profile $request)
    {
        $request->validated();

        $emailUser = User::where(['email' => request()->get('email')])->first();

        // If Email Changes
        if (Auth::user()->email != request()->get('email')) {
            $changes = request()->all();
            $changes['is_legal'] = $changes['is_legal']??0;
            $changes['newsletter'] = $changes['newsletter']??0;
            // If there is unregistered user with changed email
            if ($emailUser && $emailUser->id != Auth::user()->id) {
                $joinUser = $emailUser->id;
            }

            EmailChange::create([
                'invokedBy'    => Auth::user()->id,
                'changes'      => $changes,
                'joinUser'     => $joinUser ?? null,
                'verifyString' => str_random(60),
            ]);
        } else {
            $changes = request()->all();
            $changes['is_legal'] = $changes['is_legal']??0;
            $changes['newsletter'] = $changes['newsletter']??0;
            Auth::user()->update($changes);
        }

        return redirect()->route('profile');
    }

    public function verify($action, $string)
    {
        if ($action == 'emailchange') {
            return $this->verifyChange($string);
        }

        return $this->verifyRegister();
    }

    public function verifyChange($verifyString)
    {
        /** @var EmailChange $changes */
        $changes = EmailChange::where(['verifyString' => $verifyString])->first();
        if ($changes && $changes->state=='sent') {
            /** @var User $usr */
            $usr = User::find($changes->invokedBy);
            if ($usr) {
                if($changes->joinUser) {
                    $this->rewriteOrders($changes->invokedBy, $changes->joinUser);
                }
                $result = $usr->update($changes->changes);
                if ($result) {
                    $changes->update(['state' => 'verified']);
                    if (!Auth::user()) {
                        Auth::login($usr->id);
                    }
                    return redirect()->route('profile');
                }
            }
        } elseif($changes && $changes->state=='verified') {
            return "Changes have been already verified";
        } else {
            return "Changes have not been found!";
        }
        return false;
    }

    private function rewriteOrders($currentUser, $userToRemove) {
        /** @var User $cu */
        $cu = User::find($currentUser);
        /** @var User $ru */
        $ru = User::find($userToRemove);

        foreach($ru->cart()->where('state', '!=', 'draft')->get()??[] as $order) {
            $order->update(['user_id', $cu->id]);
        }

        $ru_openCart = $ru->cart()->where('state', 'draft')->first();
        $cu_openCart = $cu->cart()->where('state', 'draft')->first();

        $cu->increment('order_count', $ru->order_count);

        if($ru_openCart->items()->count()>0) {
            $ru_openCart->items()->update('order_header_id', $cu_openCart->id);
        }
        $ru_openCart->delete();
        $ru->delete();
    }

    public function verifyRegister()
    {
        dd(request()->all());
    }

    /**
     * @param bool $id
     * @param bool $page
     *
     * @throws NotFoundHttpException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history($id = false, $page = false) {
        if($id && $id!=__('translations.urlPage')) {
            return $this->showHistoryItem($id);
        }
        if(!$page || (int)$page==$page) {
            /** @var Builder $o */
            $o = Auth::user()->orders();

            /** @var LengthAwarePaginator $orders */
            if($page) {
                $orders = $o->paginate(1, ['*'], 'lapa', $page);
            } else {
                $orders = $o->paginate(1);
            }
            return view('frontend.pages.history', ['orders' => $orders, 'pageTitle' => _t('translations.orderhistory')]);
        }
        abort(404);
    }

    private function showHistoryItem($orderId) {

        /** @var Builder $o */
        $o = Auth::user()->orders($orderId);

        /** @var OrderHeader $order */
        $order = $o->first();

        return view('frontend.pages.historyItem', ['order' => $order, 'pageTitle' => view('frontend.partials.orderHistoryTitle', ['data' => $order->toArray()])->render()]);
    }
}