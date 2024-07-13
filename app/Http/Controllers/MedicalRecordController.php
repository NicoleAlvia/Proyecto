<?php

namespace App\Controllers;

use App\Models\MedicalRecord;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MedicalRecordController {
    public function getMedicalRecords(Request $request, Response $response) {
        $records = MedicalRecord::all();
        $response->getBody()->write($records->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getMedicalRecord(Request $request, Response $response, $args) {
        $record = MedicalRecord::find($args['id']);
        if ($record) {
            $response->getBody()->write($record->toJson());
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Record not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function createMedicalRecord(Request $request, Response $response) {
        $data = $request->getParsedBody();
        $record = MedicalRecord::create($data);
        $response->getBody()->write($record->toJson());
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function updateMedicalRecord(Request $request, Response $response, $args) {
        $record = MedicalRecord::find($args['id']);
        if ($record) {
            $data = $request->getParsedBody();
            $record->update($data);
            $response->getBody()->write($record->toJson());
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Record not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deleteMedicalRecord(Request $request, Response $response, $args) {
        $record = MedicalRecord::find($args['id']);
        if ($record) {
            $record->delete();
            $response = $response->withStatus(204);
        } else {
            $response = $response->withStatus(404)->getBody()->write(json_encode(['error' => 'Record not found']));
        }
        return $response->withHeader('Content-Type', 'application/json');
    }
}
