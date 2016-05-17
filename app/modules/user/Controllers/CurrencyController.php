<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Helpers\LogFileHelper;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageTitle'] = "Currency";
        $data['currencies']= Currency::paginate(10);
        return view('user::currency.index',$data);
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
        $input = $request->all();
        #print_r($input);exit;
        date_default_timezone_set("Asia/Dacca");
        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            $input_data = [
                'title'=>$input['title'],
                'value'=>$input['value'],
                'description'=>$input['description']
            ];
            //print_r($input_data);exit;
            Currency::create($input_data);
            DB::commit();
            Session::flash('message', 'Successfully added!');
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
//            dd($e->getMessage());
            Session::flash('danger', $e->getMessage());
            LogFileHelper::log_error('add-currency', $e->getMessage());
        }

        return redirect()->back();
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

        $data['pageTitle'] = 'Edit Currency';

        $data['currency_old'] = Currency::findOrFail($id);
        return view('user::currency.update', $data);
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
        $input = $request->all();
        #print_r($input);exit;
        date_default_timezone_set("Asia/Dacca");
        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //print_r($input_data);exit;
            $currency = Currency::find($id);

            $currency->title = $input['title'];
            $currency->description = $input['description'];
            $currency->value = $input['value'];

            $currency->save();
            DB::commit();
            Session::flash('message', 'Successfully updated!');
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
//            dd($e->getMessage());
            Session::flash('danger', $e->getMessage());
            LogFileHelper::log_error('edit-currency/'.$id, $e->getMessage());
        }

        return redirect('view-currency');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            //print_r($input_data);exit;
            $currency = Currency::find($id);
            $currency->delete();
            DB::commit();
            Session::flash('message', 'Successfully deleted!');
        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
//            dd($e->getMessage());
            Session::flash('danger', $e->getMessage());
            LogFileHelper::log_error('view-currency/'.$id, $e->getMessage());
        }

        return redirect('view-currency');
    }

}
