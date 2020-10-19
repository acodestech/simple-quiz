<?php

namespace App\Http\Controllers;

use JsValidator;
use Validator;
use App\Rules\ValidDate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getRules()
    {
        return $this->searchRules = [
            'input_date' => ['required', new ValidDate],
        ];
    }

    public function getRulesMessages()
    {
        return $this->searchRulesMessages = [
            'input_date.required' => __('Please Enter Date')
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $validator = JsValidator::make($this->getRules(), $this->getRulesMessages(), [], '#date-form');
        return view('home', ['validator' => $validator]);
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
        //
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

    public function getData(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getRules(), $this->getRulesMessages());

        if ($validator->fails()) {
            $messageBags = $validator->getMessageBag()->toArray();
            foreach ($messageBags as $messageBag) {
                $message = $messageBag[0];
            }

            return response()->json([
                'status' => 0,
                'message' => $message
            ]);
        } else {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->input_date . ' 08:00:00');
            $status = $date->isWeekday() ? 1 : 0;
            $message = $date->isWeekday() ? __('Retrieved successfully') : __('Not available');
            $results = [];

            if ($date->isWeekday()) {
                for ($i=0; $i<20; $i++) {
                    $iter = date("g:i a", strtotime($date->addMinutes(30))) . ' (10 slots)';
                    array_push($results, 
                        $iter
                    );
                }
            }

            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $results
            ]);
        }
    }
}