<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    /**
     * @param int $client
     * /cliente/{id}
     */
    public function getClient(int $client)
    {
        $client = Client::find($client);
        if (!$client) {
            return response()->json(['error' => 'not found'], 404);
//            abort(404);
        }

        return response()->json($client);
    }

    /**
     * @param int $client
     * /consulta/final-placa/{numero}
     */
    public function getAllClientsWhoHaveTheSameLicensePlateEnds(int $client)
    {
        if (!$this->isSingleDigitGetRequest($client)) {
            return response()->json([
                'error' => 'Unprocessable Entity',
                'message' => 'the value must be between [0-9]'
            ], 422);
        }

        $clients = Client::where('license_plate', 'like', '%' . $client)->paginate(5);

        return response()->json($clients);
    }

    /**
     * @param int $client
     * @return bool
     */
    private function isSingleDigitGetRequest(int $client): bool
    {
        return $client >= 0 && $client <= 9;
    }

    /**
     * @param Request $request
     * /cliente
     */
    public function createClient(Request $request)
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'CPF' => 'required|unique:clients|',
            'license_plate' => 'required|min:7|max:7'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => 'Unprocessable Entity',
                'message' => $validation->errors()
            ], 422);
        }

        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->CPF = $request->CPF;
        $client->license_plate = $request->license_plate;
        $client->save();

        return response()->json(['message' => 'resource created successfully', 'client' => $client], 201);

    }

    /**
     * @param int $client
     * /cliente/{id}
     */
    public function editClient(Request $request,int $id)
    {
//        var_dump($request->all());die();
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'error' => 'not found'
            ], 404);

        }

        $rules = [
            'CPF' => 'unique:clients',
            'license_plate' => 'min:7|max:7'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'error' => 'Unprocessable Entity',
                'message' => $validation->errors()
            ], 422);
        }
        $client->update($request->all());



        return response()->json(['message' => 'resource updated successfully', 'client' => $client], 204);
    }

    /**
     * @param int $client
     * cliente/{id}
     */
    public function deleteClient(int $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['error' => 'not found'], 404);

        }

        $client->delete();
        return response()->json([], 204);
    }
}


