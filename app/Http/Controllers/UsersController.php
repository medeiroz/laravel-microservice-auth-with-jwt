<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Faz o tratamento da query com:
         * Seleção
         * Filtros
         * Ordernação
         **/
        $resources = User::treat($request->all());

        //Verifica se precisa buscar todos os registros ou paginado
        if($request->per_page == 'all'){
            $resources = ['data' => $resources->get()];

        }else{

            $per_page = ((int) $request->per_page) ?: 15;
            $resources = $resources->paginate($per_page);

            //Adiciona a request na paginação
            $resources->appends($request->all());
        }

        //retorna a colletion com o objeto
        return response()->json($resources);
    }


    /**
     * Store a newly created resource in storage.
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $aux_request = $request->all();

        if ($aux_request['password'])
            $aux_request['password'] = Hash::make($aux_request['password']);

        $user = User::create($aux_request);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $aux_request = $request->all();

        if (isset($aux_request['password']))
            $aux_request['password'] = Hash::make($aux_request['password']);

        $user->update($aux_request);

        return response()->json($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Register deleted successfully'], 201);
    }
}
