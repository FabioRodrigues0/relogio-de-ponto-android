<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->users_type_id == 1) {
            $search = request()->query('search') ? request()->query('search') : null;
            $type = request()->query('type') ? request()->query('type') : null;


            if ($search || $type) {
                $showUsers = $this->findUsers($search, $type);
            } else {
                $showUsers = $this->getUsers();
            }

            $countUsersNumber = $this->countUsers();
            $countPasswordsNumber = $this->countPasswords();

            return view('pages.users', compact('showUsers', 'countUsersNumber', 'countPasswordsNumber'));
        } else {
            return redirect()->route('login');
        }
    }

    public function home()
    {

        $performance = $this->userPerformance();
        $userTime = $this->getLastEntrance();
        $allUserData = $this->getAllPresences();
        $userAlerts = $this->getUserAlerts();
        $loggedToday = $this->checkIfLoggedToday();
        $loggedOutToday = $this->checkIfLoggedOutToday();

        if (Auth::user()->users_type_id == 1) {
            return view('pages.adminHome', compact('userTime', 'allUserData', 'performance', 'userAlerts', 'loggedToday', 'loggedOutToday'));
        }
        else{
        return view('pages.home', compact('userTime', 'allUserData', 'performance', 'userAlerts', 'loggedToday', 'loggedOutToday'));
    }
    }

    public function viewContact($id)
    {
        $ourUser = User::where('id', $id)->first();
        return view('pages.viewUsers', compact('ourUser'));
    }

    public function updateUser(Request $request)
    {
        $photo = null;

        if ($request->hasFile('photo')) {
            $photo = Storage::putFile('uploadedImages', $request->photo);
        }

        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'foto' => $photo
            ]);

        return redirect()->route('users.home')->with('message', 'Contacto atualizado com sucesso!');
    }



    public function deleteUser($id)
    {
        DB::table('presence_record')->where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    public function showUserProfile($id)
    {
        $userInfo = DB::table('users')->where('id', $id)->first();
        return view('pages.profile', compact('userInfo'));
    }

    public function getUsers()
    {
        $allUsers = DB::table('users')
            ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
            ->leftJoin(
                DB::raw('(SELECT users_id, status, updated_at FROM password_request WHERE id IN (SELECT MAX(id) FROM password_request GROUP BY users_id)) AS pr'),
                'pr.users_id',
                '=',
                'users.id'
            )
            ->select('users.*', 'users_type.type', 'pr.status')
            ->orderBy('users.id')
            ->get();

        return $allUsers;
    }

    public function getUserAlerts()
    {
        $id = Auth::user()->id;

        $userAlerts = DB::table('users')
            ->where('users.id', $id)
            ->join('password_request', 'password_request.users_id', '=', 'users.id')
            ->where('status', 'pending')
            ->first();

        return $userAlerts;
    }


    public function countUsers()
    {
        $countUsers = DB::table('users')
            ->count();

        return $countUsers;
    }

    public function countPasswords()
    {
        $countPasswords = DB::table('password_request')
            ->select('status')
            ->where('status', 'pending')
            ->count();

        return $countPasswords;
    }

    public function findUsers($search, $type)
    {
        $users = DB::table('users')
            ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
            ->leftJoin(DB::raw('(SELECT users_id, status, updated_at FROM password_request WHERE id IN (SELECT MAX(id) FROM password_request GROUP BY users_id)) AS pr'), 'pr.users_id', '=', 'users.id')
            ->select('users.*', 'users_type.type', 'pr.status')
            ->where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->where('users.name', 'LIKE', "%{$search}%")
                        ->orWhere('users.email', 'LIKE', "%{$search}%");
                }
            })
            ->when($type, function ($query) use ($type) {
                $query->where('users_type.id', '=', $type);
            })
            ->orderBy('users.id')
            ->simplePaginate(5);

        return $users;
    }


    public function getLastEntrance()
    {
        $id = Auth::user()->id;

        $checkTime = DB::table('presence_record')
            ->where('user_id', $id)
            ->select('date', 'entry_time', 'exit_time')
            ->orderBy('date', 'desc')
            ->first();

        if ($checkTime && $checkTime->entry_time && $checkTime->exit_time) {
            $entryTime = Carbon::parse($checkTime->entry_time);
            $exitTime = Carbon::parse($checkTime->exit_time);
            $checkTime->total_time = $exitTime->diff($entryTime)->format('%H:%I');
        }

        return ($checkTime);
    }


    //PRESENÇAS -----------------------------------------------------------------

    public function getAllPresences()
    {
        $id = Auth::user()->id;
        $checkAllFields = DB::table('presence_record')
            ->where('user_id', $id)
            ->join('attendance_mode', 'presence_record.attendance_mode_id', '=', 'attendance_mode.id')
            ->select('presence_record.date', 'presence_record.entry_time', 'presence_record.exit_time', 'attendance_mode.description')
            ->orderBy('date', 'desc')
            ->get();
        // ->cursorPaginate(5);

        foreach ($checkAllFields as $presence) {
            $entryTime = Carbon::parse($presence->entry_time);
            $exitTime = Carbon::parse($presence->exit_time);

            if ($presence->exit_time) {
                $presence->total_time = $entryTime->diff($exitTime)->format('%H:%I');
            } else {
                $presence->total_time = 'Ainda sem dados';
            }
        }


        return ($checkAllFields);
    }





    public function userPerformance()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $id = Auth::user()->id;

        $entrances = DB::table('presence_record')
            ->join('users', 'users.id', '=', 'presence_record.user_id')
            ->where('user_id', $id)
            ->whereBetween('presence_record.entry_time', [$monthStart, $monthEnd])
            ->select(
                'users.name',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, presence_record.entry_time, presence_record.exit_time)) as total_minutes'),
                DB::raw('
                100 - (AVG(ABS(
                    (HOUR(presence_record.entry_time) * 60 + MINUTE(presence_record.entry_time))
                    - (HOUR(presence_record.entry_time) * 60)
                )) / 60) * 100 AS punctuality_percentage
            ')
            )
            ->groupBy('users.name')
            ->first();

        if (!$entrances) {
            return (object) [
                'name' => Auth::user()->name,
                'total_minutes' => 0,
                'punctuality_percentage' => 0,
                'total_hours' => '00:00',
            ];
        }

        $totalMinutes = $entrances->total_minutes ?? 0;
        $totalHours = $entrances->total_hours ?? 0;

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        $totalHours = sprintf("%02d:%02d", $hours, $minutes);

        $entrances->total_hours = $totalHours;
        return $entrances;
    }

    public function passwordRequest()
    {
        DB::table('password_request')->insert([
            'users_id' => auth::user()->id,
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Solicitação de alteração de palavra-passe enviada com sucesso!');
    }

    public function checkInRequest()
    {
        DB::table('presence_record')->insert([
            'date' => now()->format('Y-m-d'),
            'entry_time' => now()->format('H:i:s'),
            'attendance_mode_id' => 1,
            'user_id' => auth::user()->id,
            'created_at' => now(),
        ]);

        return redirect()->route('home.page')->with('message', 'Olá! Entrada realizada com sucesso!');
    }


    public function checkOutRequest()
    {
        DB::table('presence_record')
            ->where('user_id', Auth::user()->id)
            ->whereDate('date', now()->format('Y-m-d'))
            ->whereNull('exit_time')
            ->update([
                'exit_time' => now()->format('H:i:s'),
                'updated_at' => now()
            ]);

        return redirect()->route('home.page')->with('message', 'Saída realizada com sucesso. Até amanhã! ');
    }

    public function checkIfLoggedToday()
    {
        $id = Auth::user()->id;

        $loggedToday =  DB::table('presence_record')
            ->join('users', 'users.id', '=', 'presence_record.user_id')
            ->where('user_id', $id)
            ->whereDate('date', now()->format('Y-m-d'))
            ->exists();


        return $loggedToday;
    }


    public function checkIfLoggedOutToday()
    {
        $id = Auth::user()->id;

        $loggedOutToday =  DB::table('presence_record')
            ->where('user_id', $id)
            ->whereDate('date', now()->format('Y-m-d'))
            ->whereNotNull('exit_time')
            ->exists();

        return $loggedOutToday;
    }
}
