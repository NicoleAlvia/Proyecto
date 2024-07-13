<?php

use User\Factory\UserFactory;
use App\Controllers\PatientController;
use App\Controllers\MedicalRecordController;
use App\Models\User;

require __DIR__ . '/../vendor/autoload.php';

$app = UserFactory ::create();

$app->group('/api/patients', function ($group) {
    $group->get('', [PatientController::class, 'getPatients']);
    $group->get('/{id}', [PatientController::class, 'getPatient']);
    $group->post('', [PatientController::class, 'createPatient']);
    $group->put('/{id}', [PatientController::class, 'updatePatient']);
    $group->delete('/{id}', [PatientController::class, 'deletePatient']);
});

$app->group('/api/medical_records', function ($group) {
    $group->get('', [MedicalRecordController::class, 'getMedicalRecords']);
    $group->get('/{id}', [MedicalRecordController::class, 'getMedicalRecord']);
    $group->post('', [MedicalRecordController::class, 'createMedicalRecord']);
    $group->put('/{id}', [MedicalRecordController::class, 'updateMedicalRecord']);
    $group->delete('/{id}', [MedicalRecordController::class, 'deleteMedicalRecord']);
});

$app->run();
