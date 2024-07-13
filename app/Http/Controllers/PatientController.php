<?php

namespace App\Controllers;

use App\Models\Patient;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PatientController {
    public function getPatients(Request $request, Response $response) {
        $patients = Patient::all();
        $response->getBody()->write($patients->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getPatient(Request $request, Response $response, $args) {
        $patient = Patient::find($args['id']);
        if ($patient) {
            $response->getBody()->write($patient->toJson());
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Patient not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createPatient(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $patient = Patient::create($data);
        $response->getBody()->write($patient->toJson());
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function updatePatient(Request $request, Response $response, $args) {
        $patient = Patient::find($args['id']);
        if ($patient) {
            $data = $request->getParsedBody();
            $patient->update($data);
            $response->getBody()->write($patient->toJson());
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Patient not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deletePatient(Request $request, Response $response, $args) {
        $patient = Patient::find($args['id']);
        if ($patient) {
            $patient->delete();
            $response = $response->withStatus(204);
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Patient not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
