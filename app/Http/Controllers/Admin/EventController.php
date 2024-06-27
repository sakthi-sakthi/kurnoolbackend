<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
       
    }
    public function create()
    {
        $event = '';
        return view('admin.events.create',compact('event'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ename' => 'required',
            'startdate' => 'required',
            'place' => 'required',
            'edesc' => 'nullable',
            'enddate' => 'nullable',
            'recurring' => 'nullable',
        ]);
    
        $startdate = \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['startdate'])->format('Y-m-d H:i:s');
        $enddate = isset($validatedData['enddate']) ? \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['enddate'])->format('Y-m-d H:i:s') : null;
        $recurring = $request->has('recurring') && $request->recurring == 'on' ? 1 : 0;
    
        $event = new Event();
        $event->ename = $validatedData['ename'];
        $event->startdate = $startdate;
        $event->enddate = $enddate;
        $event->place = $validatedData['place'];
        $event->edesc = $validatedData['edesc'];
        $event->recurring = $recurring;
        $event->save();
    
        if ($recurring) {
            $currentDate = \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['startdate']);
            $currentEndDate = $enddate ? \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['enddate']) : null;
    
            while ($currentDate->year == \Carbon\Carbon::now()->year) {
                $currentDate->addMonth();
                if ($currentDate->year != \Carbon\Carbon::now()->year) break;
    
                $newStartDate = $currentDate->copy();
                $newEndDate = $currentEndDate ? $currentEndDate->copy()->addMonth() : null;
    
                $recurringEvent = new Event();
                $recurringEvent->ename = $validatedData['ename'];
                $recurringEvent->startdate = $newStartDate->format('Y-m-d H:i:s');
                $recurringEvent->enddate = $newEndDate ? $newEndDate->format('Y-m-d H:i:s') : null;
                $recurringEvent->place = $validatedData['place'];
                $recurringEvent->edesc = $validatedData['edesc'];
                $recurringEvent->recurring = $recurring;
                $recurringEvent->save();
    
                if ($currentEndDate) {
                    $currentEndDate->addMonth();
                }
            }
        }
    
        return redirect()->back()->with('success', 'Event saved successfully!');
    }
    public function show($id)
    {
       
    }
    public function edit($id)
    {
        $event = Event::find($id);

        if ($event) {
            return response()->json(['status' => 'success', 'data' => $event]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Event not found!'], 404);
        }
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ename' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'startdate' => 'required',
            'enddate' => 'nullable',
            'edesc' => 'nullable',
        ]);

        try {
            $startdate = \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['startdate'])->format('Y-m-d H:i:s');
            $enddate = isset($validatedData['enddate']) ? \Carbon\Carbon::createFromFormat('m/d/Y h:i a', $validatedData['enddate'])->format('Y-m-d H:i:s') : null;
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid date format!'], 422);
        }

        $event = Event::find($id);

        if (!$event) {
            return response()->json(['status' => 'error', 'message' => 'Event not found!'], 404);
        }

        $event->ename = $validatedData['ename'];
        $event->place = $validatedData['place'];
        $event->startdate = $startdate;
        $event->enddate = $enddate;
        $event->edesc = $validatedData['edesc'];
        $event->recurring = $request->has('recurring') && $request->recurring == 'on' ? 1 : 0;

        $event->save();

        return response()->json(['status' => 'success', 'message' => 'Event updated successfully.']);
    }


    public function destroy($id)
    {
        $event = Event::find($id);

        if ($event) {
            $event->delete();
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Event not found!'], 404);
        }
    }

}
