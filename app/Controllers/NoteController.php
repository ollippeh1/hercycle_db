<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NoteModel;

class NoteController extends BaseController
{
    public function index()
    {
        $jumlah_gelas = session()->get('jumlah_gelas') ?? 0;

        return view('note/index', [
            'jumlah_gelas' => $jumlah_gelas,
            'current' => 'note',
        ]);
    }

    public function updateDrink()
    {
        $jumlah_gelas = (int) $this->request->getPost('current_amount');
        $action = $this->request->getPost('action');

        if ($action === 'increase' && $jumlah_gelas < 20) {
            $jumlah_gelas++;
        } elseif ($action === 'decrease' && $jumlah_gelas > 0) {
            $jumlah_gelas--;
        }

        session()->set('jumlah_gelas', $jumlah_gelas);

        return redirect()->to('/note')->with('message', 'Data disimpan!');
    }

   public function save()
{
    $noteModel = new NoteModel();

    $data = [
        'condition'       => $this->request->getPost('condition'),
        'ovulation_test'  => $this->request->getPost('ovulation_test'),
        'intercourse'     => implode(', ', $this->request->getPost('intercourse') ?? []),
        'symptoms'        => implode(', ', $this->request->getPost('symptoms') ?? []),
        'moods'           => implode(', ', $this->request->getPost('mood') ?? []),
        'weight'          => $this->request->getPost('weight_value'),
        'height'          => $this->request->getPost('height_value'),
        'drink_water'     => $this->request->getPost('jumlah_gelas'),
    ];

    $noteModel->save($data);

    return redirect()->to('/note')->with('message', 'Data catatan berhasil disimpan!');
}
}
