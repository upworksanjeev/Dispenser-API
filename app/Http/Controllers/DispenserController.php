<?php

namespace App\Http\Controllers;

use App\Models\Dispenser;
use Carbon\Carbon;
use App\Models\Attendee;
use App\Http\Requests\DispenserRequest;
use App\Http\Requests\DispenserCloseRequest;
use App\Http\Requests\DispenserOpenRequest;

class DispenserController extends Controller
{

    /**
     * Create a new dispenser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(DispenserRequest $request)
    {
        $dispenser = Dispenser::create([
                    'flow_volume' => $request->input('flow_volume'),
                    'status' => 'close',
        ]);

        return response()->json(['message' => 'Dispenser created successfully', 'dispenser' => $dispenser], 201);
    }

    /**
     * Open a dispenser and create an attendee record.
     *
     * @param  \App\Http\Requests\DispenserOpenRequest  $request
     * @param  \App\Models\Dispenser  $dispenser
     * @return \Illuminate\Http\JsonResponse
     */
    public function openDispenser(DispenserOpenRequest $request, Dispenser $dispenser)
    {
        $dispenser->status = 'open';
        $dispenser->timestamps = false;
        $dispenser->save();

        // create an attendee 
        $attendee = new Attendee();
        $attendee->dispenser_id = $dispenser->id;
        $attendee->opened_at = new Carbon();
        $attendee->total_spent = 0;
        $attendee->save();

        return response()->json(['message' => 'Dispenser status updated successfully', 'attendee' => $attendee]);
    }

    /**
     * Close a dispenser and update attendee records.
     *
     * @param  \App\Http\Requests\DispenserCloseRequest  $request
     * @param  \App\Models\Attendee  $attendee
     * @return \Illuminate\Http\JsonResponse
     */
    public function closeDispenser(DispenserCloseRequest $request, Attendee $attendee)
    {
        $dispenser = Dispenser::findOrFail($attendee->dispenser_id);
        $dispenser->timestamps = true;
        $dispenser->status = 'close';
        $dispenser->save();

        $attendee->closed_at = new Carbon();
        $openTime = new Carbon($attendee->opened_at);
        $closeTime = new Carbon($attendee->closed_at);
        $usageTime = $closeTime->diffInSeconds($openTime);
        $attendee->total_spent = $usageTime * $dispenser->flow_volume;
        //$attendee->total_spent = 0;
        $attendee->save();

        return response()->json(['message' => 'Dispenser status updated successfully', 'attendee' => $attendee, 'dispenser' => $dispenser]);
    }

    public function getUsage(Dispenser $dispenser)
    {
        // Retrieve usage information for a specific dispenser
        // Implement as per your requirements (e.g., return JSON response or generate a report).
    }

}
