<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class DataController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        // Formula Hitung Umur dan Masa Kerja
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['birth_date'] = Carbon::parse($data[$i]['birth_date'])->age;
            $data[$i]['birth_date'] = $data[$i]['birth_date'] . " Tahun";

            // // Join Date
            $tanggal = new DateTime($data[$i]['join_date']);

            // tanggal hari ini
            $today = new DateTime('today');

            // tahun
            $y = $today->diff($tanggal)->y;

            // bulan
            $m = $today->diff($tanggal)->m;

            // hari
            $d = $today->diff($tanggal)->d;

            if ($y > 0) {
                $data[$i]['join_date'] = $y . " Tahun";
            } else {
                if ($m > 0) {
                    $data[$i]['join_date'] = $m . " Bulan";
                } else {
                    $data[$i]['join_date'] = $d . " Hari";
                }
            }
        }
        return view('index', [
            "title" => "Dashboard-Admin",
            "employees" => $data
        ]);
    }

    public function tambah()
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $position = $contentArray['position'];
        $division = $contentArray['division'];
        return view('tambah', [
            "title" => "Tambah-Data",
            'division' => $division,
            'position' => $position
        ]);
    }

    public function store(Request $request)
    {
        $parameter = [
            'position_id' => $request->position_id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'join_date' => $request->join_date,
            'is_active' => $request->is_active
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        echo $contentArray['status'];

        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('/tambah')->withErrors($error)->withInput();
        } else {
            return redirect()->to('/')->with('success', "Data berhasil di tambah");
        }
    }

    public function edit($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees/$id";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $position = $contentArray['position'];
        $division = $contentArray['division'];
        // dd($data);
        return view('edit', [
            "title" => "Ubah-Data",
            "employees" => $data,
            'division' => $division,
            'position' => $position
        ]);
    }

    public function update(Request $request, string $id)
    {
        $parameter = [
            'position_id' => $request->position_id,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'join_date' => $request->join_date,
            'is_active' => $request->is_active
        ];

        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        echo $contentArray['status'];

        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('/tambah')->withErrors($error)->withInput();
        } else {
            return redirect()->to('/')->with('success', "Data berhasil di ubah");
        }
    }



    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/employees/$id";
        $response = $client->request('DELETE', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);

        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('/')->withErrors($error)->withInput();
        } else {
            return redirect()->to('/')->with('success', "Data berhasil di hapus");
        }
    }
}
