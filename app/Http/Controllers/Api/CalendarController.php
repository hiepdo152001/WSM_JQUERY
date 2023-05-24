<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * @var CalendarService
     *
     */
    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }


    public function createTimeKeep()
    {
        $users = $this->getCurrentLoggedIn();
        $id = $users->id;
        $time_keep = $this->calendarService->create($id);

        if ($time_keep === null) {
            return response()->json([
                'message' => 'create not success'
            ], 500);
        }

        return response()->json(
            $time_keep,
            200
        );
    }

    public function updateTimeKeep()
    {
        $users = $this->getCurrentLoggedIn();
        $id = $users->id;
        $time_keep = $this->calendarService->update($id);

        if ($time_keep === null) {
            return response()->json([
                'message' => 'update not success'
            ], 500);
        }

        return response()->json(
            $time_keep,
            200
        );
    }


    public function getTimeKeep()
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;

        $time_keep = $this->calendarService->getByUserId($id);

        if ($time_keep === null) {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }

        return response()->json(
            $time_keep,
            200
        );
    }

    public function getByDay()
    {
        $user = $this->getCurrentLoggedIn();
        $id = $user->id;
        $time_keep = $this->calendarService->getByDay($id);
        return response()->json(
            $time_keep,
        );
    }
}
