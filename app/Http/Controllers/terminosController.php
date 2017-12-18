<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateterminosRequest;
use App\Http\Requests\UpdateterminosRequest;
use App\Repositories\terminosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Wamania\Snowball\Spanish;
class terminosController extends AppBaseController
{
    /** @var  terminosRepository */
    private $terminosRepository;

    public function __construct(terminosRepository $terminosRepo)
    {
        $this->terminosRepository = $terminosRepo;
    }

    /**
     * Display a listing of the terminos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->terminosRepository->pushCriteria(new RequestCriteria($request));
        $terminos = db::table('termino')->paginate(10);

        return view('terminos.index')
            ->with('terminos', $terminos);
    }

    /**
     * Show the form for creating a new terminos.
     *
     * @return Response
     */
    public function create()
    {
        return view('terminos.create');
    }

    /**
     * Store a newly created terminos in storage.
     *
     * @param CreateterminosRequest $request
     *
     * @return Response
     */
    public function store(CreateterminosRequest $request)
    {
        $input = $request->all();
 $stemmer = new Spanish();
        $terminos = db::table('termino')->insert(['nombre'=>$stemmer->stem($request->input('nombre'))]);

        Flash::success('Terminos saved successfully.');

        return redirect(route('terminos.index'));
    }

    /**
     * Display the specified terminos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $terminos = db::table('termino')->where('id',$id)->get();

        if (empty($terminos)) {
            Flash::error('Terminos not found');

            return redirect(route('terminos.index'));
        }

        return view('terminos.show')->with('terminos', $terminos->all());
    }

    /**
     * Show the form for editing the specified terminos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $terminos = db::table('termino')->where('id',$id)->get();

        if (empty($terminos)) {
            Flash::error('Terminos not found');

            return redirect(route('terminos.index'));
        }

        return view('terminos.edit')->with('terminos', $terminos);
    }

    /**
     * Update the specified terminos in storage.
     *
     * @param  int              $id
     * @param UpdateterminosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateterminosRequest $request)
    {
        $stemmer = new Spanish();
         $terminos = db::table('termino')->where('id',$id)->get();

        if (empty($terminos)) {
            Flash::error('Terminos not found');

            return redirect(route('terminos.index'));
        }

         $terminos = db::table('termino')->where('id',$id)->update(['nombre'=>$stemmer->stem($request->input('nombre'))]);

        Flash::success('Terminos updated successfully.');

        return redirect(route('terminos.index'));
    }

    /**
     * Remove the specified terminos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $terminos = db::table('termino')->where('id',$id)->get();

        if (empty($terminos)) {
            Flash::error('Terminos not found');

            return redirect(route('terminos.index'));
        }

       $terminos = db::table('termino')->where('id',$id)->delete();

        Flash::success('Terminos deleted successfully.');

        return redirect(route('terminos.index'));
    }
}
