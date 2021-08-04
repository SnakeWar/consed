<?php

namespace App\Http\Controllers\Admin;

use App\Models\Organizacao;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class ReportController extends Controller
{
    protected $report;
    protected $title;

    public function __construct(Report $report)
    {
        $this->report = $report;
        $this->title = 'Relatórios';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = $this->report->orderBy('id', 'desc')->paginate(10);

        $data = ['reports' => $reports, 'title' => $this->title];

        return view('admin.reports.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizacoes = Organizacao::all();

        $data = ['organizacoes' => $organizacoes, 'title' => $this->title, 'subtitle' => 'Adicionar relatório'];

        if(isset($catorganizacoes)){
            $data['catorganizacoes'] = $catorganizacoes;
        }

        return view('admin.reports.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['data_inicio'] = convertdata_todb($dataForm['data_inicio']);

        if($dataForm['data_final']) {
            $dataForm['data_final'] = convertdata_todb($dataForm['data_final']);
        }

        $report = $this->report->create($dataForm);

        if(!$report) return redirect('/admin/reports')->with('fail', 'Falha ao criar o Relatório!');

        return redirect('/admin/reports')->with('success', 'Relatório inserido com sucesso!');

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
        $report = $this->report->findOrFail($id);
        $organizacoes = Organizacao::all();

        $data = ['report' => $report, 'organizacoes' => $organizacoes, 'title' => $this->title, 'subtitle' => 'Editar relatório'];

        return view('admin.reports.form')->with($data);
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
        $report = $this->report->findOrFail($id);
        $dataForm = $request->all();

        $dataForm['data_inicio'] = convertdata_todb($dataForm['data_inicio']);

        if($dataForm['data_final']) {
            $dataForm['data_final'] = convertdata_todb($dataForm['data_final']);
        }

        $updated = $report->update($dataForm);

        if(!$updated) return redirect('/admin/reports')->with('fail', 'Falha ao editar o Relatório!');

        return redirect('/admin/reports')->with('success', 'Relatório editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->report->destroy($id);

        if(!$deleted) return redirect('/admin/reports')->with('fail', 'Falha ao excluir o Relatório!');

        return redirect('/admin/reports')->with('success', 'Relatório excluido com sucesso!');
    }

    public function generatePDF($id)
    {
        $report = $this->report->findOrFail($id);

        $data = ['title' => $report->title, 'gestor' => $report->gestor, 'conteudo' => $report->conteudo];

        $pdf = PDF::loadView('admin.reports.template', $data);

        return $pdf->download($report->title.'.pdf');
    }
}
