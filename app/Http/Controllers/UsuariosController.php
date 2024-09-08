<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Exception;

/**
 *  @OA\Info(
 *      title="API Documentation",
 *      version="1.0",
 *      description="Documentação da API Usuários"
 * )
 * 
 *  @OA\Server(url="http://localhost:8000")
 */



class UsuariosController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/usuarios",
     *      tags={"Usuários"},
     *      summary="Listar todos os usuários",
     *      description="Retorna a lista de usuários.",
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function index() {
        return response()->json(['usuarios' => Usuarios::all()], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/usuarios/{cpf}",
     *     tags={"Usuários"},
     *     summary="Buscar um usuário pelo CPF",
     *     description="Retorna as informações de um usuário baseado no CPF fornecido.",
     *     @OA\Parameter(
     *         name="cpf",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              example=12345678900
     *         ),
     *         description="CPF do usuário a ser buscado"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário encontrado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     )
     * )
     */
    public function findUser($cpf) {
        try {
            $usuario = Usuarios::findOrFail($cpf);
            return response()->json(['usuario' => $usuario], 200);
        } catch (Exception $e) {
            return response()->json(['mensagem' => 'Usuário não encontrado!'], 404);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/usuarios",
     *     tags={"Usuários"},
     *     summary="Cadastrar um novo usuário",
     *     description="Realiza o cadastro de um novo usuário.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cpf", "nome", "data_nascimento"},
     *             @OA\Property(property="cpf", type="unsignedBigInteger", example=12345678900),
     *             @OA\Property(property="nome", type="string", example="Name"),
     *             @OA\Property(property="data_nascimento", type="string", format="date", example="2000-01-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário cadastrado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Não foi possível cadastrar o usuário"
     *     )
     * )
     */
    public function store(Request $r) {
        try {
            Usuarios::create([
                "cpf" => $r->cpf,
                "nome" => $r->nome,
                "data_nascimento" => $r->data_nascimento
            ]);

            return response()->json(['mensagem' => 'Usuário cadastrado com sucesso.'], 200);
        } catch (Exception $e) {
            return response()->json(['mensagem' => 'Não foi possível cadastrar o usuário.'], 500);
        }
    }
}