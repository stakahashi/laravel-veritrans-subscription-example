<?php

namespace App\Http\Controllers;

require_once app_path() . '/Vendors/tgMdkPHP/tgMdk/3GPSMDK.php';

use Illuminate\Http\Request;
use App\Models\Subscription;
use Cake\Chronos\Date;

class SubscriptionController extends Controller
{
    const TARGET_GROUP_ID = 'Veritrans_Dummy_02';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

            $subscription = new Subscription($request->all());
            $subscription->start = Date::create()
                ->addMonth(1)
                ->day(1)
                ->format('Y-m-d');
            $subscription->save();

            $req = new \CardAuthorizeRequestDto();

            $req->setAccountId($subscription->id);
            $req->setOrderId($subscription->id);
            $req->setAmount($subscription->plan->price);
            $req->setCardNumber($request->input('number'));
            $req->setCardExpire(implode('/', [
                $request->input('month'),
                $request->input('year')
            ]));
            $req->setSecurityCode($request->input('cvv'));


            $req->setGroupId(self::TARGET_GROUP_ID);
            $req->setOneTimeAmount(0);
            $req->setRecurringAmount($subscription->plan->price);

            $transaction = new \TGMDK_Transaction();
            $res = $transaction->execute($req);

            if ($res->getMStatus() !== 'success') {
                throw new \Exception($res->getMerrMsg());
            }

            \DB::commit();
        } catch (\Exception $e) {
            session()->flash('msg', $e->getMessage());
            \DB::rollBack();
        }

        return redirect()->route('user.show', [
            'id' => $request->input('user_id')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
