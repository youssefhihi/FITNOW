<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
               $id = Auth::user()->id;
            $Progress = Progress::where('user_id',$id)->latest()->get();
            return response()->json(
                [
                    "status" => true,
                    "data" => $Progress
                ],200
                ) ;
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage()
                ], 500);
            }   
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
        if (Auth::check()) {
            $request->validate([
                'weight' => 'required',
                'height' => 'required',
                'waist_line' => 'required',
                'bicep_thickness' => 'required',
                'pec_width' => 'required',
                'performance' => 'required',
                'additional_notes' => 'required',
            ]);
            
            
            $success = Progress::create([
                'user_id' => Auth::id(),
                'weight' => $request->weight,
                'height' => $request->height,
                'waist_line' => $request->waist_line,
                'bicep_thickness' => $request->bicep_thickness,
                'pec_width' => $request->pec_width,
                'performance' => $request->performance,
                'additional_notes' => $request->additional_notes,
            ]);      
            if($success){
            return response()->json([
                "status" => 1,
                "message" => 'progress added'
            ],200);
         }else{
            return response()->json([
                "status" => 0,
                "message" => 'error'
            ],500);
        }}else{
            return response()->json([
                "status" => 0,
                "message" => 'not auth'
            ],500);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progress  $Progress
     * @return \Illuminate\Http\Response
     */
    public function show(Progress $Progress)
    {
        return [
            "status" => 1,
            "data" =>$Progress
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progress  $Progress
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Progress $Progress)
    {
        if(Auth::id() == $Progress->user_id){
            $request->validate([
                'status'=> 'required|in:finish,unfinish',
            ]);
    
            $Progress->update($request->all());
    
            return response()->json([
                "status" => 1,
                "data" => $Progress,
                "msg" => "Progress updated successfully"
            ],200);
        }else{
            return response()->json([
                "status" => 0,
                "msg" => "not yours"
            ],200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progress  $Progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progress $Progress)
    {
        if(Auth::id() == $Progress->user_id){
        $request->validate([
            'weight'=> 'required',
            'height'=> 'required',
            'waist_line'=> 'required',
            'bicep_thickness'=> 'required',
            'pec_width'=> 'required',
            'performance'=> 'required',
        ]);

        $Progress->update($request->all());

        return response()->json([
            "status" => 1,
            "data" => $Progress,
            "msg" => "Progress updated successfully"
        ],200);
    }else{
        return response()->json([
            "status" => 0,
            "msg" => "not yours"
        ],403);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progress  $Progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progress $Progress)
    {
        if(Auth::id() == $Progress->user_id){
        $Progress->delete();
       return response()->json([
            "status" => 1,
            "msg" => "Progress delated successfully"
        ],200);
    }else{
        return response()->json([
            "status" => 0,
            "msg" => "not yours"
        ],403);
    }
    }
}