<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BiodataLaravel;
use App\HobiModel;
use App\GenderModel;
use Validator;
class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(BiodataLaravel::latest()->get())->addColumn('action',function($data){
                $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= "&nbsp;&nbsp;";
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                $button .= "&nbsp;&nbsp;";
                $button .= '<button type="button" name="detail" id="'.$data->id.'" class="detail btn btn-info btn-sm">Detail</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $genders = GenderModel::select('gender')->get();
        $hobbys = HobiModel::select('hobi')->get();
        return view('biodata.index',['genders'=>$genders],['hobbys'=>$hobbys]); // ngelempar data array bentuknya json
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
        $rules = array(
            'nama_lengkap'  => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'hobi'          => 'required'
        );

        $error = Validator::make($request->all(),$rules);

        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }
        // proses hobi
        $jumlah_hobi = count($request->hobi);
        $hobies = '';
        for ($i=0; $i < $jumlah_hobi; $i++) { 
         $hobies.=$request->hobi[$i].",";
        }
        $hobi = substr($hobies,0, strlen($hobies)-1);

        $form_data = array(
            'nama_lengkap'  => $request->nama_lengkap,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hobi'          => $hobi
        );

        BiodataLaravel::create($form_data);
        return response()->json(['success' => 'Data Added Successfully.']);
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
    public function edit(Request $request,$id)
    {
        if ($request->ajax()) {
            $data = BiodataLaravel::findOrFail($id);
            return response()->json(['data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'nama_lengkap_edit'  => 'required',
            'tanggal_lahir_edit' => 'required',
            'jenis_kelamin_edit' => 'required',
            'hobi_edit'          => 'required'
        );

        $error = Validator::make($request->all(),$rules);

        if ($error->fails()) {
            return response()->json(['errors'=>$error->errors()->all()]);
        }

        $jumlah_hobi = count($request->hobi_edit);
        $hobies = '';
        for ($i=0; $i < $jumlah_hobi; $i++) { 
         $hobies.=$request->hobi_edit[$i].",";
        }
        $hobi = substr($hobies,0, strlen($hobies)-1);

        $form_data = array(
            'nama_lengkap'  => $request->nama_lengkap_edit,
            'tanggal_lahir' => $request->tanggal_lahir_edit,
            'jenis_kelamin' => $request->jenis_kelamin_edit,
            'hobi'          => $hobi
        );

        BiodataLaravel::whereId($request->id_edit)->update($form_data);

        return response()->json(['success'=>'Data is Successfully Update.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = BiodataLaravel::findOrFail($id);
        $data->delete();
    }
}
