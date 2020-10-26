<?php

namespace App\Http\Controllers;

use App\Models\Legislador;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LegisladorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Legislador::query();
            return DataTables::eloquent($model)->toJson();
        }
        return view('legislador.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('legislador.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parties = ['Azul', 'Rojo', 'Verde'];

        $request->validate([
            'name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'adress' => 'nullable|string|max:255',
            'country' => 'required|string|alpha|max:255',
            'votes' => 'required|numeric|min:0',
            'party' => 'nullable|string|alpha|max:5|in:Azul,Rojo,Verde',
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        if($request->input('party')==null)
        {
            $party = $parties[rand(0,2)];
            $automatic = true;
        }

        $mandato_fin = date("Y-m-d", strtotime($request->input('end')));

        $legislator = new Legislador;
        $legislator->nombre = $request->input('name');
        $legislator->apellido = $request->input('last_name');
        $legislator->email = $request->input('email');
        $legislator->telefono = $request->input('phone');
        $legislator->direccion = $request->input('adress');
        $legislator->pais = $request->input('country');
        $legislator->votos_obtenidos = $request->input('votes');
        $legislator->mandato_inicio = $request->input('start');
        $legislator->mandato_fin = $mandato_fin;
        if(isset($automatic))
        {
            $legislator->partido_politico = $party;
            $legislator->automatico = $automatic;
        }else
        {
            $legislator->partido_politico = $request->input('party');
        }
        if($legislator->save())
        {
            return view('legislador.success');
        }
        else
        {
            return redirect()->back()->with('save_error', 'Hubo un error al guardar el legislador en la base de datos, por favor intente nuevamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $legislador = Legislador::find($id);
        return view('legislador.show', ['legislador' => $legislador]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $legislador = Legislador::find($id);
        return view('legislador.edit', ['legislador' => $legislador]);
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
        $parties = ['Azul', 'Rojo', 'Verde'];

        $request->validate([
            'name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
            'adress' => 'nullable|string|max:255',
            'country' => 'required|string|alpha|max:255',
            'votes' => 'required|numeric|min:0',
            'party' => 'nullable|string|alpha|max:5|in:Azul,Rojo,Verde',
            'start' => 'required|date',
            'end' => 'required|date|after:start'
        ]);

        if($request->input('party')==null)
        {
            $party = $parties[rand(0,2)];
            $automatic = true;
        }

        $mandato_fin = date("Y-m-d", strtotime($request->input('end')));

        $legislator = Legislador::find($id);
        $legislator->nombre = $request->input('name');
        $legislator->apellido = $request->input('last_name');
        $legislator->email = $request->input('email');
        $legislator->telefono = $request->input('phone');
        $legislator->direccion = $request->input('adress');
        $legislator->pais = $request->input('country');
        $legislator->votos_obtenidos = $request->input('votes');
        $legislator->mandato_inicio = $request->input('start');
        $legislator->mandato_fin = $mandato_fin;
        if(isset($automatic))
        {
            $legislator->partido_politico = $party;
            $legislator->automatico = $automatic;
        }else
        {
            $legislator->partido_politico = $request->input('party');
        }
        if($legislator->save())
        {
            $request->session()->flash('success', 'Sus cambios han sido guardados.');
            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with('save_error', 'Hubo un error al guardar los cambios, por favor intente nuevamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $legislador = Legislador::find($request->input('id'));

        $legislador->delete();

        $success = (['message' => 'success']);

        return json_encode($success);

    }

    public function filterLegislastor(Request $request)
    {
        $id = null;
        $date_from = null;
        $date_to = null;
        $party = null;
        foreach($request->get('postData') as $item)
        {
            switch($item['name'])
            {
                case "id":
                    if(!is_int(intval($item['value'])))
                    {
                        $error = ['message' => 'id'];
                        return json_encode($error);
                    }else
                    {
                        $id = $item['value'];
                    }
                    break;
                case "date_from":
                    $date_from = $item['value'];
                    if (date('Y-m-d', strtotime($date_from)) != $date_from) {
                        $error = ['message' => 'date_from'];
                        return json_encode($error);
                    }
                    break;
                case "date_to":
                    $date_to = $item['value'];
                    if (date('Y-m-d', strtotime($date_to)) != $date_to) {
                        $error = ['message' => 'date_to'];
                        return json_encode($error);
                    }else
                    {
                        if(isset($date_from))
                        {
                            if(strtotime($date_from > strtotime($date_to)))
                            {
                                $error = ['message' => 'dates'];
                                return json_encode($error);
                            }
                        }
                    }
                    $date_to = $date_to." 23:59";
                    break;
                case "party":
                    $party = '%'.($item['value']).'%';
                    break;
                default:
                    if($item['name'] != "date_from_submit" && $item['name'] != "date_to_submit")
                    {
                        $error = ['message' => 'default'];
                        return json_encode($error);
                    }
                    break;
            }
        }
        if($date_to != null && $date_from != null)
        {
            $legislators = Legislador::whereRaw('id = IFNULL(:id,id)',['id'=>$id])
                ->whereRaw('partido_politico LIKE IFNULL(:party,partido_politico)',['party'=>$party])
                ->whereRaw('mandato_inicio > IFNULL(:mandato_inicio,mandato_inicio)',['mandato_inicio' => $date_from])
                ->whereRaw('mandato_fin < IFNULL(:mandato_fin,mandato_fin)',['mandato_fin' => $date_to]);
        }else if($date_to!= null && $date_from == null)
        {
            $legislators = Legislador::whereRaw('id = IFNULL(:id,id)',['id'=>$id])
                ->whereRaw('partido_politico LIKE IFNULL(:party,partido_politico)',['party'=>$party])
                ->whereRaw('mandato_fin < IFNULL(:mandato_fin,mandato_fin)',['mandato_fin' => $date_to]);

        }elseif ($date_from!= null && $date_to==null)
        {
            $legislators = Legislador::whereRaw('id = IFNULL(:id,id)',['id'=>$id])
                ->whereRaw('partido_politico LIKE IFNULL(:party,partido_politico)',['party'=>$party])
                ->whereRaw('mandato_inicio > IFNULL(:mandato_inicio,mandato_inicio)',['mandato_inicio' => $date_from]);
        }elseif($date_to==null && $date_from==null)
        {
            $legislators = Legislador::whereRaw('id = IFNULL(:id,id)',['id'=>$id])
                ->whereRaw('partido_politico LIKE IFNULL(:party,partido_politico)',['party'=>$party]);
        }
        return Datatables::eloquent($legislators)->toJson();
    }
}
