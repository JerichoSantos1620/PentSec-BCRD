<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonalDataFormRequest;
use App\Models\PersonalDataForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function personalDataSheet()
    {
        $form = Auth::user()->personalDataForm;

        $isLocked = false;
        $nextUpdateDate = null;

        if ($form) {
            $nextUpdateDate = Carbon::parse($form->updated_at)->addMonths(12);
            $isLocked = now()->lt($nextUpdateDate);
        }

        return view('user.personal-data-sheet', compact('form', 'isLocked', 'nextUpdateDate'));
    }

    public function storePersonalData(StorePersonalDataFormRequest $request)
    {
        $user = Auth::user();
        $existingForm = $user->personalDataForm;

        // Enforce 12-month lock on updates
        if ($existingForm) {
            $nextUpdateDate = Carbon::parse($existingForm->updated_at)->addMonths(12);
            if (now()->lt($nextUpdateDate)) {
                return redirect('/personal-data-sheet')
                    ->withErrors(['lock' => 'Your data is locked until ' . $nextUpdateDate->format('F d, Y') . '. Updates are only allowed once every 12 months.']);
            }
        }

        $user->personalDataForm()->updateOrCreate(
            ['user_id' => $user->id],
            $request->validated()
        );

        return redirect('/personal-data-sheet')->with('success', 'Personal Data Sheet submitted successfully.');
    }

    public function downloadPdf()
    {
        $user = Auth::user();
        $form = $user->personalDataForm;

        if (! $form) {
            return redirect('/personal-data-sheet')
                ->withErrors(['pdf' => 'You must submit your Personal Data Sheet before downloading.']);
        }

        $pdf = Pdf::loadView('user.personal-data-sheet-pdf', compact('form', 'user'));

        // Format filename: remove spaces from full name, append _PDS.pdf
        $filename = str_replace(' ', '', $form->full_name) . '_PDS.pdf';

        return $pdf->download($filename);
    }

}
