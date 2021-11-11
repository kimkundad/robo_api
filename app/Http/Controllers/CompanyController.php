<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        $response = Http::withToken('eyJhbGciOiJSUzI1NiIsImtpZCI6IjE5OEI5NTVGNTlENzE1RjE0QUI5QjcxQkFBQzhBMzBDMzg5MkNFMjQiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiJHWXVWWDFuWEZmRkt1YmNicXNpakREaVN6aVEifQ.eyJuYmYiOjE2MzY1MzY5MzEsImV4cCI6MTYzNjU1NDkzMSwiaXNzIjoibnVsbCIsImF1ZCI6IklkZW50aXR5U2VydmVyQXBpIiwiY2xpZW50X2lkIjoicm9ib3RlbF93ZWIiLCJzdWIiOiJjZTY5OTJmMi0zZGE0LTRmYjctODc2ZS1hNDA4YzRmMDIwNmYiLCJhdXRoX3RpbWUiOjE2MzY1MzY5MzEsImlkcCI6ImxvY2FsIiwic2NvcGUiOlsib3BlbmlkIiwicHJvZmlsZSIsIklkZW50aXR5U2VydmVyQXBpIl0sImFtciI6WyJwd2QiXX0.LdIHLgbqL8DkuosKkTB_JLKUZo02W5ySkgMbV8Li2aMZu8w5gVn3PLceXOrjJgjPjyuPqN8rzQnlZwht46YfTD1orYnZI1D-Kqs5r-_H-uzUiqsiDoNF87Ax2VdWbl4wl9z0dILwLtErJi9_ocwm-IlPkfJihJJyuzdms8GQHiKkJVCJ82_EfiR4ZWE5iD3MHY1u9-rIPxiyBJmOQ_PFlOIA8eem0gh1SGEXh9WEMub_a2eibBkUrarlaovx-K1d65srDFyD42wj9cweE0O5bBdnlFX9ZukUq9ikYNW-jRdUKepuTw6Pli18lp0RPtbXegmaBiUCfJYge4O_k-sj8Q')
        ->get('https://siamtheatre.com/api/v1/company',
        [
            'Page' => 1,
            'PageSize' => 100
        ]);

        $perPage = 10;
        $collection = collect(json_decode($response, true));
      //  dd($collection);
        $search = '';
        $data = $this->paginate($collection['items'], $perPage);
        $data_tatal = $collection['items'];
        return view('admin.company.index', compact('data', 'data_tatal', 'search'));
    }

    public function paginate($items, $perPage, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
        $data['objs'] = '';
        return view('admin.company.edit', $data);
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
